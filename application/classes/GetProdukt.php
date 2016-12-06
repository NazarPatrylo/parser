<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetProdukt
 *
 * @author Nazar
 */
include('simple_html_dom.php');
class GetProdukt {

    public function getLink(){

    $arraLink = array();

    $html = file_get_html($_POST['url']);
    $findLink = $html->find($_POST['elem']);

    foreach($findLink as $element){
        array_push($arraLink, $element->href);
    }

    echo json_encode($arraLink);
    }

    public function addToDB(){
        $arraLink = array();
        $html = file_get_html($_POST['url']);
        $findLink = $html->find($_POST['elem']);
        $title = $html->find('h1');
        $code = $html->find('span.detail-code-i');
        $obj_db = new DB();
        $obj_db->query("INSERT INTO computers SET  cpu='". trim ( strip_tags($findLink[0]))."',
            screen='". trim ( strip_tags($findLink[1]))."',
            ram='". trim ( strip_tags($findLink[2]))."',
            type_ram='". trim ( strip_tags($findLink[3]))."',
            os='". trim ( strip_tags($findLink[4]))."',
            opis='". trim ( strip_tags($findLink[5]))."',
            HDD='". trim ( strip_tags($findLink[6]))."',
            cd_rom='". trim ( strip_tags($findLink[7]))."',
            color='". trim ( strip_tags($findLink[8]))."',
            weight='". trim ( strip_tags($findLink[9]))."',
            name='". trim ( strip_tags($title[0]))."',
            code='". trim ( strip_tags($code[0]))."',
            link='".$_POST['url']."',
            data='".date('Y-m-d H:i:s')."'
        ");

        echo json_encode($arraLink);
    }

    public function getElement(){
        $obj_db = new DB();

            $dom = new DomDocument('1.0');
            $computers = $dom->appendChild($dom->createElement('computers'));

            $result = $obj_db->query2("CALL ".$_POST['procedura']);
            foreach ($result as $row){

              $computer = $computers->appendChild($dom->createElement('computer'));
              $id = $computer->appendChild($dom->createElement('id'));
              $id->appendChild($dom->createTextNode( $row['id'] ));
              $name = $computer->appendChild($dom->createElement('name'));
              $name->appendChild($dom->createTextNode( $row['name'] ));
              $code = $computer->appendChild($dom->createElement('code'));
              $code->appendChild($dom->createTextNode( $row['code'] ));
              $cpu = $computer->appendChild($dom->createElement('cpu'));
              $cpu->appendChild($dom->createTextNode( $row['cpu'] ));
              $screen = $computer->appendChild($dom->createElement('screen'));
              $screen->appendChild($dom->createTextNode( $row['screen'] ));
              $ram = $computer->appendChild($dom->createElement('ram'));
              $ram->appendChild($dom->createTextNode( $row['ram'] ));
              $type_ram = $computer->appendChild($dom->createElement('type_ram'));
              $type_ram->appendChild($dom->createTextNode( $row['type_ram'] ));
              $os = $computer->appendChild($dom->createElement('os'));
              $os->appendChild($dom->createTextNode( $row['os'] ));
              $opis = $computer->appendChild($dom->createElement('opis'));
              $opis->appendChild($dom->createTextNode( $row['opis'] ));
              $HDD = $computer->appendChild($dom->createElement('HDD'));
              $HDD->appendChild($dom->createTextNode( $row['HDD'] ));
              $cd_rom = $computer->appendChild($dom->createElement('cd_rom'));
              $cd_rom->appendChild($dom->createTextNode( $row['cd_rom'] ));
              $color = $computer->appendChild($dom->createElement('color'));
              $color->appendChild($dom->createTextNode( $row['color'] ));
              $weight = $computer->appendChild($dom->createElement('weight'));
              $weight->appendChild($dom->createTextNode( $row['weight'] ));
              $link = $computer->appendChild($dom->createElement('link'));
              $link->appendChild($dom->createTextNode( $row['link'] ));
              $data = $computer->appendChild($dom->createElement('data'));
              $data->appendChild($dom->createTextNode( $row['data'] ));
            }


            $dom->formatOutput = true;
            $test1 = $dom->saveXML();
            $name_xml = rand(1000, 99999999).'.xml';
            $dom->save('files/'.$name_xml);

        echo json_encode($name_xml);
    }
    public function getCountElement(){
        $obj_db = new DB();
        $dom = new DomDocument('1.0');
        $computers = $dom->appendChild($dom->createElement('computers'));
        $result = $obj_db->query2("CALL ".$_POST['procedura']);
        foreach ($result as $row){
          $computer = $computers->appendChild($dom->createElement('computer'));
          $count = $computer->appendChild($dom->createElement('count'));
          $count->appendChild($dom->createTextNode( $row['count'] ));
        }
        $dom->formatOutput = true;
        $test1 = $dom->saveXML();
        $name_xml = rand(1000, 99999999).'.xml';
        $dom->save('files/'.$name_xml);
        echo json_encode($name_xml);
    }

    public function setLog(){
        $obj_db = new DB();
        $obj_db->query("CALL LOG('".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_ACCEPT_LANGUAGE']."','".$_SERVER['HTTP_USER_AGENT']."','".date('Y-m-d H:i:s')."','"."CALL ".$_POST['procedura']."') ");
    }

    function getCountLogiIP(){

        $data1 = date('Y-m-d H:i:s');
        $date = new DateTime($data1);
        $date->sub(new DateInterval('PT00H60S'));
        $data2 = $date->format('Y-m-d H:i:s');

        $obj_db = new DB();
        $res = $obj_db->query2(" CALL GET_COUNT_LOG('".$data2."', '".$data1."','".$_SERVER['REMOTE_ADDR']."' ) ");
        return $res[0]['count'];
    }


    function getCountElementFormat(){
      print_r($_POST);
    }
    function getElementFormat(){
      //print_r($_POST);
      $obj_db = new DB();
      $name_xml='';

      switch ($_POST['format']) {
        case 'XML':

    		$dom = new DOMDocument( "1.0", "ISO-8859-15" );
		    $dom->preserveWhiteSpace = false;
		    $dom->formatOutput = true;
				$xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/css" href="http://parser.you-web.xyz/src/css/'.$_POST['style'].'.css"');
			  $dom->appendChild($xslt);

              $computers = $dom->appendChild($dom->createElement('computers'));

              $result = $obj_db->query2("CALL ".$_POST['procedura']);
              foreach ($result as $row){

                $computer = $computers->appendChild($dom->createElement('computer'));
                $id = $computer->appendChild($dom->createElement('id'));
                $id->appendChild($dom->createTextNode( $row['id'] ));
                $name = $computer->appendChild($dom->createElement('name'));
                $name->appendChild($dom->createTextNode( $row['name'] ));
                $code = $computer->appendChild($dom->createElement('code'));
                $code->appendChild($dom->createTextNode( $row['code'] ));
                $cpu = $computer->appendChild($dom->createElement('cpu'));
                $cpu->appendChild($dom->createTextNode( $row['cpu'] ));
                $screen = $computer->appendChild($dom->createElement('screen'));
                $screen->appendChild($dom->createTextNode( $row['screen'] ));
                $ram = $computer->appendChild($dom->createElement('ram'));
                $ram->appendChild($dom->createTextNode( $row['ram'] ));
                $type_ram = $computer->appendChild($dom->createElement('type_ram'));
                $type_ram->appendChild($dom->createTextNode( $row['type_ram'] ));
                $os = $computer->appendChild($dom->createElement('os'));
                $os->appendChild($dom->createTextNode( $row['os'] ));
                $opis = $computer->appendChild($dom->createElement('opis'));
                $opis->appendChild($dom->createTextNode( $row['opis'] ));
                $HDD = $computer->appendChild($dom->createElement('HDD'));
                $HDD->appendChild($dom->createTextNode( $row['HDD'] ));
                $cd_rom = $computer->appendChild($dom->createElement('cd_rom'));
                $cd_rom->appendChild($dom->createTextNode( $row['cd_rom'] ));
                $color = $computer->appendChild($dom->createElement('color'));
                $color->appendChild($dom->createTextNode( $row['color'] ));
                $weight = $computer->appendChild($dom->createElement('weight'));
                $weight->appendChild($dom->createTextNode( $row['weight'] ));
                $link = $computer->appendChild($dom->createElement('link'));
                $link->appendChild($dom->createTextNode( $row['link'] ));
                $data = $computer->appendChild($dom->createElement('data'));
                $data->appendChild($dom->createTextNode( $row['data'] ));
              }


              $dom->formatOutput = true;
              $test1 = $dom->saveXML();
              $name_xml = rand(1000, 99999999).'.xml';
              $dom->save('files/'.$name_xml);


          break;
        case 'JSON':
          $result = $obj_db->query2("CALL ".$_POST['procedura']);
          $name_xml = rand(1000, 99999999).'.json';
          $fp = fopen('files/'.$name_xml, 'w');
          fwrite($fp, json_encode($result));
          fclose($fp);

          break;
        case 'YAML':
          $result = $obj_db->query2("CALL ".$_POST['procedura']);
          $name_xml = rand(1000, 99999999).'.json';
          $fp = fopen('files/'.$name_xml, 'w');


          $addr = array(
    "given" => "Chris",
    "family"=> "Dumars",
    "address"=> array(
        "lines"=> "458 Walkman Dr.
        Suite #292",
        "city"=> "Royal Oak",
        "state"=> "MI",
        "postal"=> 48046,
      ),
  );
          $invoice = array (
      "invoice"=> 34843,
      "date"=> 980208000,
      "bill-to"=> $addr,
      "ship-to"=> $addr,
      "product"=> array(
          array(
              "sku"=> "BL394D",
              "quantity"=> 4,
              "description"=> "Basketball",
              "price"=> 450,
            ),
          array(
              "sku"=> "BL4438H",
              "quantity"=> 1,
              "description"=> "Super Hoop",
              "price"=> 2392,
            ),
        ),
      "tax"=> 251.42,
      "total"=> 4443.52,
      "comments"=> "Late afternoon is best. Backup contact is Nancy Billsmer @ 338-4338.",
    );
          fwrite($fp, yaml_emit($invoice));
          fclose($fp);
          break;
        case 'OGDL':

          break;

        default:

          break;
      }
      $res ['name'] = $name_xml;
      $res ['format'] = $_POST['format'];
      //$res ['result'] = $result;

      echo json_encode($name_xml);
    }
}
