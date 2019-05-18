<?php namespace Sukohi\FluentCsv;

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