<?php

function xmlToArray($xmlstring)
{
	$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
	return json_decode(json_encode($xml),TRUE);
}

function arrayToXml($array, $root = '<root/>')
{
	$xml = new SimpleXMLElement($root);
	array_walk_recursive($array, array ($xml, 'addChild'));
	return $xml->asXML();
}