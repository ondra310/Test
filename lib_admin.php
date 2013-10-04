<?PHP
//neco se musi zmenit
//--------------------------------------------------------------------------------------------------------opEditCentre
/** zobrazi menu pro spouštění dalších editačních funkcí */
function opEditCentre($silent){
   if (authorizeToLevelSilent(3)):
   		echo "not Silent";
      $path = urlPath();
      echo '<div class="cona"><!--fc lib_admin/F opEditCentre/C -->
          <h4>'._('Editační centrum, zvolte oblast, kterou si přejete editovat').'</h4>
          <hr />
          <a href="'.$path.'?opType=opKatCon&amp;cm=noC">'._('editace kategorií').'</a><br />
          -- <a href="'.$path.'?opType=opKatAdd&amp;cm=noC">'._('VLOŽIT kategorii').'</a><br />

          <hr /><a href="'.$path.'?opType=opVyrCon&amp;cm=noC">'._('editace výrobků').'</a><br />
          -- <a href="'.$path.'?opType=opVyrAdd&amp;cm=noC">'._('VLOŽIT výrobek').'</a><br />

          <hr /><a href="'.$path.'?opType=opProdCon&amp;cm=noC">'._('editace výrobců').'</a><br />
          -- <a href="'.$path.'?opType=opProdAdd&amp;cm=noC">'._('VLOŽIT výrobce').'</a><br />

          <hr /><a href="'.$path.'?opType=opDodCon&amp;cm=noC">'._('editace dodavatelů').'</a><br />
          -- <a href="'.$path.'?opType=opDodAdd&amp;cm=noC">'._('VLOŽIT dodavatele').'</a><br />

          <hr /><a href="'.$path.'?opType=opVarCon&amp;cm=noC">'._('editace variant').'</a><br />
          -- <a href="'.$path.'?opType=opVarCon&amp;opSubType=recAdd&amp;cm=noC">'._('VLOŽIT sadu variant').'</a><br />

           <hr />
             - <a href="'.$path.'?opType=opHtmlCen&amp;fltr=page&amp;cm=noC">'._("ediace horní menu").'</a><br />
             - <a href="'.$path.'?opType=opHtmlCen&amp;fltr=act&amp;cm=noC">'._('editace aktuality').'</a><br />
          <hr />
          </div><!-- END class="cona" -->';
      endif;//endif za authorizeLevel

     // <hr /><a href="'.$path.'?opType=opProfCon&amp;cm=noC">editace marží</a><br />
     // <hr /><a href="'.$path.'?opType=opHtmlCen&amp;cm=noC">editace statických stránek Eshopu</a><br />
   }//end opEditCentre
//END------------------------------------------------------------------------------------------------ end opEditCentre


//------------------------------------------------------------------------------------------------------------opControl
/** zobrazi menu pro spouštění kontrolnich fuknci eshopu */
function opControl(){
   if (authorizeToLevel(3)):
      $path = urlPath();
      echo '<div class="cona adminMenuConfig"><!--fc lib_admin/F opControl/C -->
          <h1>'._('Nastavení a konfigurace eshopu').'</h1>


          <fieldset>
            <strong>'._('kontroly a generování').':</strong><br />
            <a href="'.$path.'?opType=opControl"> -> '._('kontroly obrázků a počtu výrobků').'</a><hr />
            <a href="'.$path.'?opType=opXmlGen"> -> '._('vygenerování XML souboru pro zbozi.cz').'</a>
          </fieldset>

          <fieldset>
          <strong>'._('výrobky a prodej').':</strong><br />
             <a href="'.$path.'?opType=opCNFSett"> -> '._('konfigurátory sestav').'</a><hr />
             <a href="'.$path.'?opType=opCodeSett"> -> '._('nastavení vícenásobných kódů výrobku').'</a>
          </fieldset>

          <fieldset>
          <strong>'._('fakturace a objednávka').':</strong><br />
              <a href="'.$path.'?opType=opInvoiceSett"> -> '._('nastavení číselných řad fakturace').'</a><hr />
              <a href="'.$path.'?opType=opEmailSett"> -> '._('nastavení emailových zpráv při změne objednávky').'</a><hr />
              <a href="'.$path.'?opType=opItemStat"> -> '._('nastavení stavů zboží v objednávce').'</a><hr />
              <a href="'.$path.'?opType=opTranSett"> -> '._('konfigurace způsobů dopravy').'</a> <hr />
              <a href="'.$path.'?opType=opColorSett"> -> '._('konfigurace barevného zvýrazňování objednávek').'</a>
          </fieldset>

          <fieldset>
           <strong>'._('uživatelé a provozní nastavení').':</strong><br />
              <a href="'.$path.'?opType=opUserCon"> -> '._('editace uživatelů').'</a><hr />
              <a href="'.$path.'?opType=opEshopSett"> -> '._('konfigurace e-shopu').'</a>
          </fieldset>


          </div><!-- END class="cona" -->';
      endif;//endif za authorizeLevel

   }//end opControl
//END----------------------------------------------------------------------------------------------------- end opControl


//-------------------------------------------------------------------------------------------------------------opProdCon
/** vypise vyrobce do prehledove tabulky */
function opProdCon(){
 if (authorizeToLevel(3)):
    $vysledek = MySQL_Query("SELECT * FROM `vyrobce` ORDER BY `id_vyrobce`");
    $path = urlPath();
    if (!$vysledek):
       $chyba = 1; printError($chyba);
    else:
      echo '
     <h4>'._('Přehled výrobců zboží').'</h4><!--fc lib_admin_vyr/F opProdCon/C -->
     <hr />
     <table class="eshop-obj" cellspacing="1" cellpadding="1">
      <tr class="zahlavi">
         <td style="width: 70px">'._('číslo výr.').'</td>
         <td style="width: 180px">'._('název').'</td>
         <td style="width: 55px">'._('zkratka').'</td>
         <td style="width: 180px">'._('www stránky').'</td>
         <td><a href="'.$path.'?opType=opProdAdd">'._('Vložit výrobce').'</a></td>
      </tr>';

    while ($zaznam = mySql_fetch_array($vysledek)):
       echo '
      <tr>
         <td class="t-right">'.$zaznam['id_vyrobce'].'</td>
         <td>'.$zaznam['nazev'].'</td>
         <td>'.$zaznam['zkratka'].'</td>
         <td>'.$zaznam['www'].'</td>
         <td class="t-cent"><a href="'.$path.'?opType=opProdEdit&amp;id='.$zaznam['id_vyrobce'].'" title="'._('editace výrobce').'">
              <img src="/!grafika/tl_edit.png" alt="'._('tlačítko editovat').'" /></a> ---
             <a href="'.$path.'?opType=opProdDel&amp;id='.$zaznam['id_vyrobce'].'" title="'._('smazání výrobce').'">
              <img src="/!grafika/tl_del.png"  alt="'._('tlačítko smazat').'" /></a> ---
             <a href="'.$path.'?opType=opProdVyr&amp;id='.$zaznam['id_vyrobce'].'" title="'._('vypsat výrobky výrobce').'">
              <img src="/!grafika/tl_zam.png"  alt="'._('tlačítko vypsat').'" /></a></td>
      </tr>';
    endwhile;

          echo '
     </table>
     <form method="get">
        <input name="opType" type="hidden" value="opEditCentre" />
        <input type="submit" value="'._('zpět').'" class="eshop-br2" />
     </form>'."\n";
       endif; //endif za if $vysledek
 endif;//endif za user
}//end opKatCon
//END-------------------------------------------------------------------------------------------------- end opKatCon

//--------------------------------------------------------------------------------------------------------fomrKat
/**
 *  zaznam obsahuje informace o osobe tak z DB v pripade aktualizace udaju
    $path obsahuje cestu k obsluhujicimu souboru
    $urlPath obsahuje informace k navratu na spousteci soubor
    $type mi udava, zda se jedna o novu registraci, nebo o modifikaci
 * 
 * @param array $zaznam
 * @param type $path
 * @param type $urlPath
 * @param type $type
 */
function prodForm($zaznam, $path, $urlPath, $type){

  $vysledek = MySQL_Query("SELECT `id_vyrobce`,`nazev` FROM `vyrobce` ORDER BY `id_vyrobce`");
  if (!$vysledek):
      $chyba = 1; printError($chyba);
  else:
      if ($type == "del") {
         $label = _('smazat'); $read=' readonly="readonly"';
      }else{
         $label = _('uložit'); $read="";
      }
      
  $standartArray = array('id_vyrobce','nazev','zkratka','www');
  foreach ($standartArray as $value){
      $zaznam[$value] = isset($zaznam[$value])?$zaznam[$value]:NULL;
      }
  
      echo '
  <form method="post" action="'.$path.'" name="katForm" onSubmit="return validate(katForm)">

    <table>
      <tr>
        <td style="width: 160px" class="t-right">'._('id výrobce').':</td>
        <td><input name="id_vyrobce" type="text" value="'.$zaznam['id_vyrobce'].'" readonly="readonly" /></td>
      </tr>
      <tr>
        <td class="t-right">'._('název výrobce').':</td>
        <td><input name="nazev" type="text" value="'.$zaznam['nazev'].'"'.$read.' /></td>
      </tr>
      <tr>
        <td class="t-right">'._('zkratka').':</td>
        <td><input name="zkratka" type="text" value="'.$zaznam['zkratka'].'"'.$read.' /></td>
      </tr>
      <tr>
        <td class="t-right">'._('www stránky výrobce').':</td>
        <td><input name="www" type="text" value="'.$zaznam['www'].'"'.$read.' /></td>
      </tr>
    </table>
    <hr />

    <input name="id_original" type="hidden" value="'.$zaznam['id_vyrobce'].'" />
    <input name="urlPath" type="hidden" value="'.$urlPath.'" />
    <input name="ulozit" type="submit" class="eshop-br9" value="'.$label.'" />
  </form>

  <form method="get">
    <input name="opType" type="hidden" value="opProdCon" />
    <input type=submit value="'._('zpět').'" class="eshop-br2" />
  </form>
      ';
  endif;//endif za Db

}//end katForm
//END-------------------------------------------------------------------------------------------------- end katForm

//--------------------------------------------------------------------------------------------------------opFirmAdd
//prida kategorii zbozi do systemu
function opProdAdd($urlPath){
 if (authorizeToLevel(3)):
  $datum = date("Y-m-d");
   echo '<h4>'._('Přidání nového výrobce').'</h4><!--fc lib_admin_vyr/F opProdAdd/C -->
   <hr />';
  $pathO = "./lib/xprodins_lib.php";
  prodForm(array(), $pathO, $urlPath, "new");
  if (isSet($_GET['lastId']) and $_GET['reStatus']):
      @list($id_kat,$nazev)=MySql_Fetch_Array(MySQL_Query("SELECT `id_vyrobce`,`nazev` FROM `vyrobce` WHERE `id_vyrobce`='$_GET[lastId]'"));
      echo '
      <hr />
      <p>'._('id posledního výrobce').': <strong>'.$id_kat.'</strong></p>
      <p>'._('název posledního výrobce').': <strong>'.$nazev.'</strong></p>
      <hr />';
      endif;
  endif;//endif za user
}//end opFirmAdd
//END-------------------------------------------------------------------------------------------------- end opFirmAdd

//--------------------------------------------------------------------------------------------------------opKatEdit
//prida kategorii zbozi do systemu
function opProdEdit($urlPath,$id_kat){
 if (authorizeToLevel(3)):
  $datum = date("Y-m-d");
  echo '<h4>'._('Editace výrobce').'</h4><!--fc lib_admin_vyr/F opProdEdit/C -->
  <hr />';
  $pathO = "./lib/xprodupd_lib.php";
  if (isSet($_GET['lastId']) and $_GET['reStatus']):
       $zaznam=MySql_Fetch_Array(MySQL_Query("SELECT `id_vyrobce`,`nazev`,`zkratka`,`www` FROM `vyrobce` WHERE `id_vyrobce`=$_GET[lastId]"));
       prodForm($zaznam, $pathO, $urlPath, "mod");
  else:
    $zaznam=MySql_Fetch_Array(MySQL_Query("SELECT `id_vyrobce`,`nazev`,`zkratka` ,`www` FROM `vyrobce` WHERE `id_vyrobce`=$id_kat"));
    prodForm($zaznam, $pathO, $urlPath, "mod");
    endif;//isSet lastId
  endif;//endif za user
}//end opKatEdit
//END-------------------------------------------------------------------------------------------------- end opKatEdit


//--------------------------------------------------------------------------------------------------------opKatDel
//smaze vyrobce
function opProdDel($urlPath,$id_kat){
 if (authorizeToLevel(3)):
  $datum = date("Y-m-d");
   echo '<h4>'._('Smazání výrobce').'</h4><!--fc lib_admin_vyr/F opProdDel/C -->
   <span class="infoRed">'._('Vybraný výrobce bude smázán! Opravdu smazat?').'</span>
   <hr />
   ';
  $pathO = "./lib/xproddel_lib.php";
  $zaznam=MySql_Fetch_Array(MySQL_Query("SELECT `id_vyrobce`,`nazev`,`www` FROM `vyrobce` WHERE `id_vyrobce`=$id_kat"));
  prodForm($zaznam, $pathO, $urlPath, "del");
  endif;//endif za user
}//end opKatDel
//END-------------------------------------------------------------------------------------------------- end opKatDel

//--------------------------------------------------------------------------------------------------------profForm
//formular pro hromadnou editaci profit Group
function profForm (){
  $vysledek = MySQL_Query("SELECT `id_group`,`nazev`, `profit` FROM `profit_group`");
  if (!$vysledek):
      printError(1);
   else:
     $urlPath = urlPath();

     echo '
     <table class="eshop-obj" cellspacing="1" cellpadding="1">
      <tr class="zahlavi">
         <td style="width: 70px;">'._('číslo skup.').'</td>
         <td style="width: 250px;">'._('název').'</td>
         <td style="width: 80px;">'._('procenta').'</td>
         <td><a href="'.$path.'?opType=opVyrAdd">'._('Vložit novou').'</a></td>
      </tr>';

     while ($profit = mysql_fetch_array($vysledek)):
       $tempStr = "./lib/p_profit_show.php?id_profit=".$profit['id_group'];
       echo '
      <tr>
         <td class="t-right">'.hUrlPop($profit['id_group'],$tempStr,800,800).'</td>
         <td><form name="'.$profit['id_group'].'" action="./lib/xprofupd_lib.php" method="post">
             <input type="text" name="nazev" value="'.$profit['nazev'].'" style="width: 245px" /></td>
         <td class="t-right"><input name="id_profit" type="hidden" value="'.$profit['id_group'].'" />
             <input name="urlPath" type="hidden" value="'.$urlPath.'" />
             <input type="text" name="profit" value='.$profit['profit'].' style="width: 20px" />%</td>
         <td><input name="save" type="submit" class="eshoprs" value="'._('save').' &gt;&gt;" /></form>
             <a href="'.$path.'?opType=opProfDel&amp;id='.$profit['id_group'].'" title="'._('smazání skupiny').'">
              <img src="/!grafika/tl_del.png"  alt="'._('tlačítko smazat').'"></a></td>
      </tr>';
     endwhile;

          echo "
     </table>
     <br />\n";
     endif;//endif za Db
}//end profForm
//END-------------------------------------------------------------------------------------------------- end profFom

//--------------------------------------------------------------------------------------------------------opProfCon
//smaze profitni skupinu
function opProfDel(){
 if ($GLOBALS[authClass]->authorizeLevel(1)):
  $formClass = new classsFormFunction;
  $formClass->fieldName = 'id_kat';
  $formClass->fieldWidth = "150";

  $formClass->dBtableName = 'profit_group';
  $formClass->valueColSelect = 'id_group';
  $formClass->showColumn = 'nazev';
  $formClass->showColumn2 = 'profit';
  $formClass->recordValue = $_GET['id'];

  if ($_POST[smazat]=="yes"):
    if (is_numeric($_POST[id])):
      $id = (int)$_POST[id] ;
      $vysledek = mySql_query("DELETE FROM `profit_group` WHERE `id_group` = '$id'");
      if ($vysledek):
        printStatus("delete",1);
        opProfCon();
      else:
        printError(12);
        endif;
      endif;//endif za is_numeric
  else://neni odeslan formular, zobrazim kontrolni formular pro potvrzeni mazani
      echo '
      <span class="infoRed">'._('Následující záznam bude smazán!').'</span>
      <form method="post" action="./";>
            <input type="hidden" name="opType" value="opProfDel" />
            <input type="hidden" name="id" value="'.$_GET['id'].'" />
            <input type="hidden" name="smazat" value="yes" />
          <br />
          <b>'.$formClass->showOneRecord().'</b>
          <br /><br />
          <input type="submit" value="'._('smazat').' &gt;&gt; " />
      </form>';
      endif;//endif za post

  endif;//endif za user
}//end opKatDel
//END-------------------------------------------------------------------------------------------------- end opKatDel


//--------------------------------------------------------------------------------------------------------opProfCon
//kontrola a editace skupin pro marze
function opProfCon(){
 if (authorizeToLevel(3)):
    echo '
     <h4>'._('Editace profitnich skupin').'</h4>
     <hr />';
  profForm();
  endif;//endif za user
}//end opKatDel
//END-------------------------------------------------------------------------------------------------- end opKatDel




//-----------------------------------------------------------------------------------------------------------------
class vyrSearch{//pomocna funkce na vytisknuti vyhledavaciho formulare
   function formSearch(){
     echo '<form name="formSearch" method="get">
           <input type="hidden" name="opType" value="opVyrCon" />
           <input type="text" name="id" />
           <input type="submit" value="'._('vyhledat').' &gt;&gt; " />
           </form>';
     }//end formSearch
}//end class vyrSearch

?>
