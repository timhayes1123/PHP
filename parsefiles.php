<?php
/**
* @author Tim Hayes
* Created 9/21/14
*
*
* Parse lines read from input file.
* Strip lines that do not meet the criteria and add them to a discard file.
* Write parsed lines to a separate output file.
*
*
**/

$infile = fopen("functions.txt", "r");
$outfile = fopen("functions_out.txt", "w");
$junk = fopen("discarded.txt", "w");
if ($infile == false) {
    print "Could not open input file\n";
    exit();
}
if ($outfile == false) {
    print "Could not open output file\n";
    exit();
}
if ($junk == false) {
    print "Could not open output file\n";
    exit();
}

$endLine = ");\n";

while (!feof($infile)) {
    // echo fgets($infile) . "\n";
    $inputLine = fgets($infile);
    $splitStringPos = strpos($inputLine, ':');
    $keepLine = true;
    if ($splitStringPos !== false) {
        // Colon found in input string. Continue parsing.
        $strippedLine = substr($inputLine, $splitStringPos + 1);
        $funcPos = strpos($strippedLine, "function");
        if ($funcPos !== false) {
            // Check that the character after "function" is a space.
            $endWordPos = $funcPos + 8;
            if (substr($strippedLine, $endWordPos, 1) === " ") {
                // Check character before "function"
                // Only keep the line if the word function is isolated by space or tab characters.
                if ($funcPos > 0) {
                    if (substr($strippedLine, $funcPos - 1, 1) !== " " && substr($strippedLine, $funcPos - 1, 1) !== "\t") {
                        $keepLine = false;
                    }
                }
            } else {
                $keepLine = false;
            }
        } else {
            // Reject line
            // fwrite($junk, $inputLine);
            $keepLine = false;
        }
        // fwrite($outfile, $outputLine);
        echo $strippedLine;
    } else {
        // fwrite($junk, $inputLine);
        $keepLine = false;
    }

    if ($keepLine) {
        fwrite($outfile, $inputLine);
    } else {
        fwrite($junk, $inputLine);
    }
}

fclose($infile);
fclose($outfile);
fclose($junk);
?>
