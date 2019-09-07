<?php

namespace App\Command;

use App\Entity\Acts;
use App\Entity\Grf;
use App\Entity\Societe;
use Doctrine\Common\Persistence\ObjectManager ;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ACTParserCommand extends Command
{
    protected static $defaultName = 'ACTParser';
    private $em;

    /**
     * ACTParserCommand constructor.
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    /**
     *
     */
    protected function configure()
    {

        $this
            ->setName("ACTParder")
            ->setDescription('Importer les fichiers de donnees ACT')
            ->addArgument('file', InputArgument::OPTIONAL, 'Nom du fichier a importer')
        ;
    }

    /**
     * Execute commande
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $file = $input->getArgument('file');

        if ($file) {
            $io->note(sprintf('You passed an argument: %s', $file));
        }
        $io->text("Parser le fichier");
        if(!file_exists($file)) {
            $io->error("Le fichier n'existe pas");
            return;
        }
        $fileLines = new \SplFileObject($file);
        $i = 0;
        $header = "";
        $content = "";
        $grfs = [];
        $societes = [];
        foreach ($fileLines as $line)
        {
            if($i< 3) {
                $header.=$line;
            }
            if(preg_match("/^<societe dat_donnees/",$line)) {
                $content = $line;
            }
            $content.= $line;
            if(preg_match("/^<\/societe>/",$line)) {
                $content.= $line;
                $xml = $header.' '.$content."</grf></fichier>";
               /* $data = simplexml_load_string($xml);
                print_r($data->grf->attributes->code)."\n";*/
                $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
                $json = json_encode($xml);
                $array = json_decode($json,TRUE);
                $code = $array['grf']['@attributes']['cod'];
                $societe = $array['grf']['societe']['societe'];
                $dat_donnees = $societe['@attributes']['dat_donnees'];
                $num_gestion = $societe['@attributes']['num_gestion'];
                $acts = $societe['acts'];
                if(!isset($grfs[$code])) {
                    $grf = $this->em->getRepository(Grf::class)->findOneBy(['code_grf' => $code]);
                    if(!$grf) {
                        $grf = new Grf();
                    }
                    $grf->setCodeGrf($code);
                    $grfs[$code] = $grf;
                    $this->em->persist($grf);
                } else {
                    $grf = $grfs[$code];
                }

                if(!isset($societes[$num_gestion])) {
                    $societe = $this->em->getRepository(Societe::class)->findOneBy(['num_gestion' => $num_gestion]);
                    if(!$societe) {
                        $societe = new Societe();
                    }
                    $societe->setCodeGfr($grf);
                    $societe->setNumGestion($num_gestion);
                    $societe->setDateDonnees($dat_donnees);
                    $societes[$num_gestion] = $societe;
                    $this->em->persist($societe);
                } else {
                    $societe = $societes[$num_gestion];
                }

                foreach ($acts['act'] as $act)
                {
                   // print_r($act);continue;
                    $type = $act['type'];
                    $dat_depot = $act['dat_depot'];
                    $dat_acte  = $act['dat_acte']??'';
                    $nature  = $act['nature']??'';
                    $num_depot_manuel = $act['num_depot_manuel'];
                    $act = $this->em->getRepository(Acts::class)->findOneBy(['type' => $type,'numero_depot_manuel'=>$num_depot_manuel]);
                    if(!$act) {
                        $act = new Acts();
                    }
                    $act->setType($type);
                    $act->setNature($nature);
                    $act->setDateActe($dat_acte);
                    $act->setDateDepot($dat_depot);
                    $act->setSociete($societe);
                    $act->setNumeroDepotManuel($num_depot_manuel);
                    $this->em->persist($act);
                }
            }

            if(preg_match("/^<\/fichier>/",$line)) {
                break;
            }
            $i++;
        }
        $io->text($header);
        $this->em->flush();


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
