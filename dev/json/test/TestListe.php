<?php
/**
 * Created by PhpStorm.
 * User: c16000805
 * Date: 26/03/18
 * Time: 14:00
 */
class Testliste {
    public function testCharger() {
        $json_source = file_get_contents("/dev/players.json");
        $json_data = json_decode($json_source, true);
        $this->assertSame(true, isset($json_data));
    }

    public function testCompter () {
        $json_source = file_get_contents("/dev/players.json");
        $json_data = json_decode($json_source, true);
        $this->assertSame(true, compter($json_data));
    }
}