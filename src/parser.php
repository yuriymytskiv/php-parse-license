<?php
function parseDriverLicenseRaw($data)
{

    // Map
    $map = ['DCA' => 'Jurisdiction-specific vehicle class', 'DBA' => 'Expiry Date', 'DCS' => 'Last Name', 'DAC' => 'First Name', 'DBD' => 'Issue Date', 'DBB' => 'Birth Date', 'DBC' => 'Gender', 'DAY' => 'Eye Color', 'DAU' => 'Height', 'DAG' => 'Street', 'DAI' => 'City', 'DAJ' => 'State', 'DAK' => 'Zip', 'DAQ' => 'License Number', 'DCF' => 'Document Discriminator', 'DCG' => 'Issue Country', 'DAH' => 'Street 2', 'DAZ' => 'Hair Color', 'DCI' => 'Place of birth', 'DCJ' => 'Audit information', 'DCK' => 'Inventory Control Number', 'DBN' => 'Alias / AKA Family Name', 'DBG' => 'Alias / AKA Given Name', 'DBS' => 'Alias / AKA Suffix Name', 'DCU' => 'Name Suffix', 'DCE' => 'Physical Description Weight Range', 'DCL' => 'Race / Ethnicity', 'DCM' => 'Standard vehicle classification', 'DCN' => 'Standard endorsement code', 'DCO' => 'Standard restriction code', 'DCP' => 'Jurisdiction-specific vehicle classification description', 'DCQ' => 'Jurisdiction-specific endorsement code description', 'DCR' => 'Jurisdiction-specific restriction code description', 'DDA' => 'Compliance Type', 'DDB' => 'Card Revision Date', 'DDC' => 'HazMat Endorsement Expiration Date', 'DDD' => 'Limited Duration Document Indicator', 'DAW' => 'Weight(pounds)', 'DAX' => 'Weight(kilograms)', 'DDH' => 'Under 18 Until', 'DDI' => 'Under 19 Until', 'DDJ' => 'Under 21 Until', 'DDK' => 'Organ Donor Indicator', 'DDL' => 'Veteran Indicator',
    // Old standard
    'DAA' => 'Customer Full Name', 'DAB' => 'Customer Last Name', 'DAE' => 'Name Suffix', 'DAF' => 'Name Prefix', 'DAL' => 'Residence Street Address1', 'DAM' => 'Residence Street Address2', 'DAN' => 'Residence City', 'DAO' => 'Residence Jurisdiction Code', 'DAR' => 'License Classification Code', 'DAS' => 'License Restriction Code', 'DAT' => 'License Endorsements Code', 'DAV' => 'Height in CM', 'DBE' => 'Issue Timestamp', 'DBF' => 'Number of Duplicates', 'DBH' => 'Organ Donor', 'DBI' => 'Non-Resident Indicator', 'DBJ' => 'Unique Customer Identifier', 'DBK' => 'Social Security Number', 'DBM' => 'Social Security Number', 'DCH' => 'Federal Commercial Vehicle Codes', 'DBR' => 'Name Suffix', 'PAA' => 'Permit Classification Code', 'PAB' => 'Permit Expiration Date', 'PAC' => 'Permit Identifier', 'PAD' => 'Permit IssueDate', 'PAE' => 'Permit Restriction Code', 'PAF' => 'Permit Endorsement Code', 'ZVA' => 'Court Restriction Code', 'DAD' => 'Middle Name'];
    // Result Array // Format as you wish
    $result = [];
    // Removing garbage from the start of data
    $formatedData = substr($data, strpos($data, 'ANSI'));
    // Your drivers license is split into an array of lines
    $lines = null;
    $lines = explode("\n", $formatedData);
    // Setting the map into just keys
    $abbrs = array_keys($map);

    // Bulk of the work
    foreach ($lines as $i => $line)
    {
        $abbr = null;
        $content = null;
        // EdgeCase getting license number from the first line
        if ($i === 0)
        {
            $abbr = 'DAQ';
            $content = trim(substr($line, strpos($line, $abbr) + 3));
        }
        else
        {
            $abbr = substr(trim($line) , 0, 3);
            $content = trim(substr(trim($line) , 3));
        }
        // If the code exists in the abbrs map that means the data is valid and will be stored in our result
        if (in_array($abbr, $abbrs))
        {
            $result[trim($abbr) ] = ['description' => trim($map[$abbr]) , 'content' => trim($content) , ];
        }
    }
    // Returning JSON string object
    return json_encode($result);
}

?>
