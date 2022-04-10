<?php

namespace App\CSP;

class cspModel
{
    function SetupStore($location, $name, $mode)
    {
        $class="CPStore";
        $store = new $class();
        $store->Open($location, $name, $mode);
        return $store;
    }

    function SetupCertificates($location, $name, $mode)
    {
        $store = $this->SetupStore($location, $name, $mode);
        return $store->get_Certificates();
    }

    function SetupCertificate($location, $name, $mode,
                            $find_type, $query, $valid_only,
                            $number)
    {
        $certs = $this->SetupCertificates($location, $name, $mode);
        if ($find_type != NULL)
        {
            $certs = $certs->Find($find_type, $query, $valid_only);
            if (is_string($certs))
                return $certs;
            else
                return $certs->Item($number);
        }
        else
        {
            $cert = $certs->Item($number);
            return $cert;
        }
    }

    public function SignXML($signType=0x00000020, $data_to_sign, $data_id, $cert_name, $base64_certKeyPin){
        $content='<?xml version="1.0" encoding="utf-8"?>
        <s:Envelope Id="main" xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
            <s:Header>
                <RequestHeader xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                    <Date>'.date('c').'</Date>
                    <MessageGUID>'.uniqid().'</MessageGUID>
                    <orgPPAGUID></orgPPAGUID>
                </RequestHeader>
            </s:Header>
            <s:Body xmlns:xsd="http://www.w3.org/2001/XMLSchema"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                <exportNsiListRequest u:Id="'.$data_id.'">
                    <ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature1-7e38a03fd-c5df-f5cd-d0a2-1e895f3045b">
                        <ds:SignedInfo>
                            <ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                            <ds:SignatureMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256"/>
                            <ds:Reference URI="#'.$data_id.'">
                                <ds:Transforms>
                                    <ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
                                    <ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                                </ds:Transforms>
                                <ds:DigestMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256"/>
                                <ds:DigestValue></ds:DigestValue>
                            </ds:Reference>
                        </ds:SignedInfo>
                        <ds:SignatureValue></ds:SignatureValue>
                        <ds:KeyInfo>
                            <ds:X509Data>
                                <ds:X509Certificate></ds:X509Certificate>
                            </ds:X509Data>
                        </ds:KeyInfo>
                    </ds:Signature>
                    '.$data_to_sign.'
                </exportNsiListRequest>
            </s:Body>
        </s:Envelope>';


        $cert = $this->SetupCertificate(CURRENT_USER_STORE, "my", STORE_OPEN_READ_ONLY,
            1, $cert_name, 0, 1);

        if (!$cert)
        {
            printf("Certificate not found\n");
            return -1;
        }

        $class="CPSigner";
        $signer = new $class();
        $signer->set_Certificate($cert);
        $signer->set_KeyPin(base64_decode($base64_certKeyPin));

        $class="CPSignedXml";
        $sd = new $class();

        $sd->set_SignatureType(0x00000020|2);
        $sd->set_Content($content);
        $sd->set_DigestMethod('urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256');
        $sd->set_SignatureMethod('urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256');

        $signedXml = $sd->Sign($signer, "//*[local-name()='Signature' and namespace-uri()='http://www.w3.org/2000/09/xmldsig#']");
        return $signedXml;
    }
}

?>
