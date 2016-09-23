<?php

/*
 *
 *  creates csv file
 */
function createCsv()
{
    $organisationDetails = array(
        10 => array(
            'name' => 'weboniseLab',
            'jobRole' => array(
                '11' => array(
                    'name' => 'devloper',
                    'created' => '2016-02-01',
                ),
                '12' => array(
                    'name' => 'sr. developer',
                    'created' => '2016-02-10',
                ),
            ),
            'cfa' => array(
                '11' => array(
                    'name' => 'php',
                    'created' => '2016-03-10',
                ),
                '12' => array(
                    'name' => 'ruby',
                    'created' => '2016-04-15',
                ),
            )
        ),
        11 => array(
            'name' => 'Hartley Lab',
            'jobRole' => array(
                '11' => array(
                    'name' => 'foront end',
                    'created' => '2016-03-01',
                ),
                '12' => array(
                    'name' => 'design',
                    'created' => '2016-03-10',
                ),
            ),
            'cfa' => array(
                '11' => array(
                    'name' => 'UI',
                    'created' => '2016-02-01',
                ),
                '12' => array(
                    'name' => 'UX',
                    'created' => '2016-01-01',
                ),
            )
        ),
        15 => array(
            'name' => 'Hartley Lab',
            'jobRole' => array(
                '11' => array(
                    'name' => 'front end',
                    'created' => '2016-03-01',
                ),
                '12' => array(
                    'name' => 'design',
                    'created' => '2016-03-10',
                ),
            )
        )
    );
    header('Content-type: application/csv');
    $headers = "Month-Year(created) || Organisation Name || Organisation ID || CFA Name || CFA ID || RFA Name || JR ID || JR Name";
    $file = fopen('php://output', 'w');
    fputcsv($file, explode('||', $headers));
    $formatted_array=processArray($organisationDetails);
    krsort($formatted_array);
    foreach($formatted_array as $key => $value) {
        fputcsv($file, explode('|', $value));

    }
    fclose($file);
}

/*
 * This function returns the processed array
 *
 */
function processArray($organisationDetails)
{
    $formatted_array = array();
    foreach ($organisationDetails as $orgId => $organisationDetail) {

        foreach ($organisationDetail['jobRole'] as $jobId => $jobDetails) {

            if ($organisationDetail['cfa']) {
                foreach ($organisationDetail['cfa'] as $cfaId => $cfaDetails) {

                    $formatted_array[$jobDetails['created']][] = $jobDetails['created'] . '|' . $organisationDetail['name'] . '|' . $orgId . '|' . $cfaDetails['name'] . '|' . $cfaId . '|' . $jobId . '|' . $jobDetails['name'] . '<br/>';

                }
            } else {
                $formatted_array[$jobDetails['created']][] = $jobDetails['created'] . '|' . $organisationDetail['name'] . '|' . $orgId . '|' . '-' . '|' . '-' . '|' . $jobId . '|' . $jobDetails['name'] . '<br/>';
            }

        }

    }
   return $formatted_array;
}


createCsv();