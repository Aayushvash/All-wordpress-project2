<?php
function HtAccessURL($pagname,$queryString='')
{
	//echo "<br> pagname : ".$pagname;
	//echo $queryString;
	//die();
	switch($pagname)
	{
		############### For Inventory #################
		case "inventory":
			$tempString=explode(':',$queryString);
			if(HTACCESS=="ON")
			{
				if($tempString[1]!='' && $tempString[2]!='')
				{
					$aboutlinkUrl="inventory/".filterHTACCES_linktitle($tempString[0])."-".filterHTACCES_linktitle($tempString[1])."-".filterHTACCES_linktitle($tempString[2])."/";
				} else {
					$aboutlinkUrl="inventory/".filterHTACCES_linktitle($tempString[0])."-".filterHTACCES_linktitle($tempString[2])."/";				}
			} else {
				$aboutlinkUrl="?page_id=380&edit=".$tempString[2];
			}
			break;
	}
	return $aboutlinkUrl;
}
function filterHTACCES_linktitle($title)
{
	$linktitle=str_replace("%","",str_replace(" ","-",$title));
	$linktitle=str_replace("(","",$linktitle);
	$linktitle=str_replace(")","",$linktitle);
	$linktitle=str_replace(":","",$linktitle);
	$linktitle=str_replace("!","",$linktitle);
	$linktitle=str_replace("&gt;","",$linktitle);
	$linktitle=str_replace("&lt;","",$linktitle);
	$linktitle=str_replace("`","",$linktitle);
	$linktitle=str_replace("'","",$linktitle);
	$linktitle=str_replace("&amp;","",$linktitle);
	$linktitle=str_replace("&quot;","",$linktitle);
	$linktitle=str_replace("&apos;","",$linktitle);
	$linktitle=str_replace("&","",$linktitle);
	$linktitle=str_replace("?","",$linktitle);
	$linktitle=str_replace("||","",$linktitle);
	$linktitle=str_replace("\"","",$linktitle);
	$linktitle=str_replace("+","",$linktitle);
	$linktitle=str_replace("=","",$linktitle);
	$linktitle=str_replace("#","",$linktitle);
	$linktitle=str_replace("}","",$linktitle);
	$linktitle=str_replace("{","",$linktitle);
	$linktitle=str_replace(";","",$linktitle);
	$linktitle=str_replace(":","",$linktitle);
	$linktitle=str_replace("~","",$linktitle);
	$linktitle=str_replace("^","",$linktitle);
	$linktitle=str_replace("[","",$linktitle);
	$linktitle=str_replace("]","",$linktitle);
	$linktitle=str_replace("»","",$linktitle);
	$linktitle=str_replace("Š","",$linktitle);
	$linktitle=str_replace("š","",$linktitle);
	$linktitle=str_replace("ª","",$linktitle);
	$linktitle=str_replace("¬","",$linktitle);
	$linktitle=str_replace("®","",$linktitle);
	$linktitle=str_replace("°","",$linktitle);
	$linktitle=str_replace("²","",$linktitle);
	$linktitle=str_replace("¶","",$linktitle);
	$linktitle=str_replace("ž","",$linktitle);
	$linktitle=str_replace("º","",$linktitle);
	$linktitle=str_replace("Œ","",$linktitle);
	$linktitle=str_replace("Ÿ","",$linktitle);
	$linktitle=str_replace("À","",$linktitle);
	$linktitle=str_replace("Â","",$linktitle);
	$linktitle=str_replace("Ò","",$linktitle);
	$linktitle=str_replace("§","",$linktitle);
	$linktitle=str_replace("©","",$linktitle);
	$linktitle=str_replace("±","",$linktitle);
	$linktitle=str_replace("µ","",$linktitle);
	$linktitle=str_replace("»","",$linktitle);
	$linktitle=str_replace("¿","",$linktitle);
	$linktitle=str_replace("¿","",$linktitle);
	$linktitle=str_replace("?","",$linktitle);
	$linktitle=str_replace("÷","",$linktitle);
	$linktitle=str_replace("","",$linktitle);
	$linktitle=str_replace("","",$linktitle);
	$linktitle=str_replace("à¹","",$linktitle);
	$linktitle=str_replace("à","",$linktitle);
	$linktitle=str_replace("¡à¹à","",$linktitle);
	$linktitle=str_replace("«à","",$linktitle);
	$linktitle=str_replace("¥à¹à","",$linktitle);
	$linktitle=str_replace("à","",$linktitle);
	$linktitle=str_replace("¥","",$linktitle);
	$linktitle=str_replace("à¹à","",$linktitle);
	$linktitle=str_replace("à","",$linktitle);
	$linktitle=str_replace("?","",$linktitle);
	$linktitle=ereg_replace("[^[:space:]a-zA-Z0-9*_.-]", "", $linktitle);

	$linktitle=str_replace("  "," ",$linktitle);
	$linktitle=str_replace("|","-",$linktitle);
	$linktitle=str_replace(",","-",$linktitle);
	$linktitle=str_replace("*","-",$linktitle);
	$linktitle=str_replace(".","-",$linktitle);
	$linktitle=str_replace("_","-",$linktitle);
	$linktitle=str_replace("/","-",$linktitle);
	$linktitle=str_replace("\\","-",$linktitle);
	$linktitle=str_replace(",","-",$linktitle);
	$linktitle=str_replace("`","-",$linktitle);
	$linktitle=str_replace("'","-",$linktitle);
	$linktitle=str_replace("-","-",$linktitle);
	$linktitle=str_replace("----","-",$linktitle);
	$linktitle=str_replace("---","-",$linktitle);
	$linktitle=str_replace("--","-",$linktitle);
	return $linktitle;
}?>