<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-6
 * Time: 下午4:44
 * Desc:
 */

namespace console\controllers;
use Yii;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\console\Exception;

class TestController extends BaseController {

    public function actionIndex() {

        Yii::info('this is index method--' . date('Y-m-d H:i:s'), 'api');
        return json_encode(['success' => 1, 'data' => [], 'message' => '操作成功']);
    }

    public function actionIndex2() {

        Yii::info('this is index2 method--' . date('Y-m-d H:i:s'), 'api');
        return json_encode(['success' => 1, 'data' => [], 'message' => '操作成功']);
    }

    public function actionExcel() {

        Yii::info('this is excel method--' . date('Y-m-d H:i:s'), 'api');
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator("ppker")
            ->setLastModifiedBy("now ppker")
            ->setTitle("test 测试")
            ->setSubject("test subject")
            ->setDescription("test description")
            ->setKeywords("test keywords")
            ->setCategory("test category");

        $spreadsheet->setActiveSheetIndex(0);

        for ($i = 2; $i <= 1000000; ++$i) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, "FName $i")
                ->setCellValue('B' . $i, "LName $i")
                ->setCellValue('C' . $i, "PhoneNo $i")
                ->setCellValue('D' . $i, "FaxNo $i")
                ->setCellValue('E' . $i, true)
                ->setCellValue('F' . $i, 'abcdefg')
                ->setCellValue('G' . $i, 'aadafdfsd')
                ->setCellValue('H' .$i, 'dddddddd');
        }

        $spreadsheet->getActiveSheet()
            ->setTitle('Simple');

        $this->write($spreadsheet, __FILE__);
        return json_encode(['success' => 1, 'data' => [], 'message' => '生成excel成功!']);


    }

    public function write(Spreadsheet $spreadsheet, $filename, array $writers = ['Xlsx', 'Xls']) {

        $spreadsheet->setActiveSheetIndex(0);
        foreach ($writers as $writeType) {
            $path = $this->getFilename($filename, mb_strtolower($writeType));
            $writer = IOFactory::createWriter($spreadsheet, $writeType);
            $writer->save($path);
        }
    }

    public function getFilename($filename, $extension = 'xlsx') {

        $originalExtension = pathinfo($filename, PATHINFO_EXTENSION);
        return $this->getTemporaryFolder() . "/" . str_replace('.' . $originalExtension, '.' . $extension, time() . '__' . basename($filename));
    }

    public function getTemporaryFolder() {

        $tempFolder = sys_get_temp_dir() . "/skyeye_excel";
        if (!is_dir($tempFolder)) {
            if (!mkdir($tempFolder) && !is_dir($tempFolder)) {
                throw new Exception("can not make dir temporary folder");
            }
        }
        return $tempFolder;

    }

    public function actionBrowser_excel() {

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator("yata")
            ->setLastModifiedBy("yata")
            ->setTItle("yata browser")
            ->setDescription("this is description")
            ->setSubject("this is subject")
            ->setKeywords("this is keyWords")
            ->setCategory("this is category");

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'A1')
            ->setCellValue('A2', 'A2')
            ->setCellValue('B1', 'B1')
            ->setCellValue('B2', 'B2');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A6', 'éàèùâêîôûëïüÿäöüç');

        $spreadsheet->getActiveSheet()->setTitle('simple');
        header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
        header('Content-Disposition: attachment;filename="01simple.ods"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Ods');
        $writer->save("php://output");
    }



}