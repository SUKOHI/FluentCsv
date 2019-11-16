<?php

namespace Sukohi\FluentCsv;

class FluentCsv {

    private $csv_data = [];
    private $encoding = 'UTF-8';

	public function download($filename) {

        $csv = $this->getCsvString();

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename*=UTF-8\'\''. rawurlencode($filename)
        ]);

    }

    public function save($path) {

        $csv = $this->getCsvString();
        return file_put_contents($path, $csv);

    }

    public function setData($csv_data, $encoding) {

        $this->csv_data = $csv_data;
        $this->encoding = $encoding;
        return $this;

    }

    public function addData($csv_data) {

        $this->csv_data[] = $csv_data;
        return $this;

    }

    public function clearData() {

        $this->csv_data = [];
        return $this;

    }

    public function setEncoding($encoding) {

        $this->encoding = $encoding;
        return $this;

    }

    public function parse($path, $encoding = '') {

	    $data = [];
        $original_data = file_get_contents($path);
        $csv_data = (!empty($encoding))
            ? mb_convert_encoding($original_data, 'utf-8', 'SJIS-win')
            : $original_data;

        $fp = tmpfile();
        fwrite($fp, $csv_data);
        fseek($fp, 0);

        while($row_data = fgetcsv($fp)) {

            $data[] = $row_data;

        }

        return $data;

    }

    private function getCsvString() {

        $fp = fopen('php://temp', 'r+b');

        foreach ($this->csv_data as $line) {

            fputcsv($fp, $line);

        }

        rewind($fp);
        $tmp = str_replace(PHP_EOL, "\r\n", stream_get_contents($fp));
        return mb_convert_encoding($tmp, $this->encoding, 'UTF-8');

    }

}
