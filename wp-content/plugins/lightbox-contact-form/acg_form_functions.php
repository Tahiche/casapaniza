<?php


/***
 * Core functions for simpler form coding
 ***/ 
function acg_createLink($url, $anchor, $class="", $onclick="", $id="") {
	$temp_link = "<a href=\"" . $url . "\"";
	$temp_link.= acg_addClass($class);
	if ($id!="") {
		$temp_link.=" id=\"" . $id . "\"";
	}
	if ($onclick!="") {
		$temp_link.=" onclick=\"" . $onclick . "\"";
	}
	$temp_link.=">" . $anchor . "</a>";
	$temp_link.=LF;
	return $temp_link;
}

function acg_createSelectOption($value, $text, $var="") {
	$temp_option = '<option value="' . $value . '"'	;
	$temp_option.= ($value==$var) ? " selected" : "";
	$temp_option.= ">" . $text . "</option>";
	return $temp_option;
}

function acg_createTextInput($inputName, $inputValue, $inputClass="", $inputMaxLength="", $inputOther="") {
	$temp_input = "<input type=\"text\" name=\"";
	$temp_input.= $inputName . "\"";
	$temp_input.= " id=\"";
	$temp_input.= $inputName . "\"";
	$temp_input.= " value=\"";
	$temp_input.= $inputValue . "\"";
	$temp_input.= acg_addClass($inputClass);
	if ($inputMaxLength) {
		$temp_input.= " maxlength=\"" . $inputMaxLength . "\"";
	}
	$temp_input.= ($inputOther) ? " " . $inputOther : "";
	$temp_input.=">";
	$temp_input.=LF;
	return $temp_input;
}

function acg_createTextArea($inputName, $inputValue, $inputClass="", $cols="", $rows="") {
	$temp_input = "<textarea name=\"";
	$temp_input.= $inputName . "\"";
	$temp_input.= " id=\"";
	$temp_input.= $inputName . "\"";
	if ($cols!="") {
		$temp_input.= " cols=\"" . $cols . "\"";
	}
	if ($rows!="") {
		$temp_input.= " rows=\"" . $rows . "\"";
	}
	$temp_input.= acg_addClass($inputClass);
	$temp_input.= ">";
	$temp_input.= $inputValue . "</textarea>";
	$temp_input.=LF;
	return $temp_input;
}

function acg_createCheckBox($inputName, $inputValue, $inputClass="checkbox", $inputID="", $inputOther="") {
	$temp_input="<input type=\"checkbox\" name=\"";
	$temp_input.=$inputName;
	$temp_input.="\"";
	if ($inputValue!=0) {
		$temp_input.=" checked";
		}
	$temp_input.=acg_addClass($inputClass);
	$temp_input.=acg_addID($inputID);
	$temp_input.=($inputOther) ? " " . $inputOther : "";
	$temp_input.=">";
	$temp_input.=LF;
	return $temp_input;
}

function acg_createRadioButton($inputName, $inputValue, $inputChecked="", $inputClass="", $onclick="") {
	$temp_input="<input type=\"radio\" name=\"";
	$temp_input.=$inputName;
	$temp_input.="\" value=\"";
	$temp_input.=$inputValue;
	$temp_input.="\"";
	if ($inputChecked!="" && $inputChecked!="no") {
		$temp_input.=" checked";
		}
	$temp_input.=acg_addClass($inputClass);
	if ($onclick!="") {
		$temp_input.=" onclick=\"" . $onclick . "\"";
	}
	$temp_input.=">";
	$temp_input.=LF;
	return $temp_input;
}

function acg_createH($h, $type="1", $class="") {
	$temp_h = "<h" . $type;
	$temp_h.= acg_addClass($class);
	$temp_h.= ">" . $h . "</h" . $type . ">" . LF;
	return $temp_h;
}

function acg_createHiddenInput($inputName, $inputValue, $inputID="") {
	$temp_input = "<input type=\"hidden\" name=\"";
	$temp_input.= $inputName;
	$temp_input.= "\" value=\"";
	$temp_input.= $inputValue;
	$temp_input.="\"";
	$temp_input.= acg_addClass("hidden");
	$temp_input.= acg_addID($inputID);
	$temp_input.=">";
	$temp_input.=LF;
	return $temp_input;
}

function acg_createSubmitInput($inputName, $inputValue, $inputClass="", $inputID = "", $inputOther="") {
	$temp_input = "<input type=\"submit\" name=\"";
	$temp_input.= $inputName;
	$temp_input.= "\" value=\"";
	$temp_input.= $inputValue . "\"";;
	$temp_input.=acg_addClass($inputClass);
	$temp_input.=acg_addID($inputID);
	$temp_input.=($inputOther) ? " " . $inputOther : "";
	$temp_input.=">";
	$temp_input.=LF;
	return $temp_input;
}

function acg_createLabel($labelText, $inputID, $class="") {
	if ($inputID=="") {$inputID="none";}
	$temp_input = "<label for=\"" . $inputID . "\"";
	$temp_input.= acg_addClass($class);
	$temp_input.= ">";
	$temp_input.= $labelText;
	$temp_input.="</label>";
	$temp_input.=LF;
	return $temp_input;
}

function acg_createYesNo($name, $val="") {
	$temp_yn = '<select name="' . $name . '">'	;
	$temp_yn.= '<option value="0">No</option>';
	$temp_yn.= '<option value="1"';
	if ($val==1) {
		$temp_yn.= ' SELECTED';
	}
	$temp_yn.= '>Yes</option></select>';
	return $temp_yn;
}

function acg_createSpan($contents, $class) {
	$temp_span = "<span";
	$temp_span.=acg_addClass($class);
	$temp_span.=">" . $contents . "</span>";
	$temp_span.=LF;
	return $temp_span;
}

function acg_createDiv($contents, $class="", $id="") {
	$temp_div = "<div";
	$temp_div.= acg_addClass($class);
	$temp_div.= acg_addID($id);
	$temp_div.=">" . LF . $contents . "</div>";
	$temp_div.=LF;
	return $temp_div;
}

function acg_createP($contents, $class="", $id="") {
	$temp_div = "<p";
	$temp_div.= acg_addClass($class);
	$temp_div.= acg_addID($id);
	$temp_div.=">" . $contents . "</p>";
	$temp_div.=LF;
	return $temp_div;
}
function acg_createRow($contents, $class="") {
	$temp_row = "<tr";
	$temp_row.= acg_addClass($class);
	$temp_row.=">" . LF . $contents . "</tr>" . LF;
	return $temp_row;
}
function acg_createCell($contents, $class="", $colspan="") {
	$temp_cell = "<td";
	$temp_cell.=acg_addClass($class);
	$temp_cell.=acg_addColspan($colspan);
	$temp_cell.=">" . $contents . "</td>" . LF;
	return $temp_cell;
}

function acg_createTable($contents, $class="") {
	$temp_table = '<table cellspacing="0" cellpadding="0"';
	$temp_table.=acg_addClass($class);
	$temp_table.=">" . LF;
	$temp_table.=$contents;
	$temp_table.= LF . "</table>" . LF;
	return $temp_table;
}

function acg_createForm($contents, $action, $class="") {
	if (stripos($action, "http://")===false) {
		$action = $_SERVER['PHP_SELF'] . $action;
	}
	$temp_form = '<form method="post" action="' . $action . '"';
	$temp_form.= acg_addClass($class);
	$temp_form.=  '>' . LF . $contents . '</form>' . LF;
	return $temp_form;
}
	
function acg_addClass($class) {
	$temp_class="";
	if ($class!="") {
		$temp_class.=" class=\"" . $class . "\"";
	}
	return $temp_class;
}

function acg_addID($id) {
	$temp_class="";
	if ($id!="") {
		$temp_class.=" id=\"" . $id . "\"";
	}
	return $temp_class;
}

function acg_addColspan($colspan) {
	$temp_cs="";
	if ($colspan!="") {
		$temp_cs.=" colspan=\"" . $colspan . "\"";
	}
	return $temp_cs;
}

function acg_validateInput($input, $type, $message, $minlength=1) {
	$type=strtoupper(substr($type,0,1));
	if (is_null($input)) {
		return $message;
	}
	switch ($type) {
		default: /* TEXT */
			if (strlen(trim($input))<$minlength) {
				return $message;
			}
			break;
		case "1":
		case "N": /* NUMERIC */
			if (!is_numeric($input)) {
				return $message;
			}
			break;
		case "3":
		case "D": /* DATE */
			echo $input . " -- " . $message . "<br>";
			if (!isDate($input)) {
				return $message;
			}
			break;
		case "4":
		case "E": /* EMAIL */
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $input)) {
			  return $message;
			}
			break;
		case "P": /* US PHONE NUMBER */
			$phone = preg_replace('/\D/', '', $input);
			# Ensure it's well-formed
			if (strlen($phone)<10) {
				return $message;
			}
			break;
	}
	return "";
}

?>
