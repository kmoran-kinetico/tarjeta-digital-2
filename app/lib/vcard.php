<?php function generateVcard(array $c): string { return "BEGIN:VCARD
VERSION:3.0
N:".$c["lastname"].";".$c["name"].";;;
FN:".$c["name"]." ".$c["lastname"]."
ORG:".$c["company"]."
TITLE:".$c["role"]."
TEL;TYPE=CELL:".$c["mobile"]."
TEL;TYPE=WORK:".$c["phone"]."
EMAIL:".$c["email"]."
ADR:;;".$c["address"].";;;;
END:VCARD"; }