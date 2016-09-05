<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class index extends aafwGETActionBase {

    public $Secure   = true;
    const PAGE_LIMIT = 15;

    public function validate() {
        return true;
    }

    public function doThisFirst() {
        if (!isset($_SESSION['login_id'])) {
            return 'redirect: /user/login';
        }
    }

    public function doAction() {
        $service     = $this->createService('ReportService');
        $total_count = $service->countAllReport();

        $this->Data['page_limited']     = self::PAGE_LIMIT;
        $this->Data['total_file_count'] = $total_count;
        $total_page = (floor($total_count / self::PAGE_LIMIT) + ($total_count % self::PAGE_LIMIT > 0));

        $this->p = Util::getCorrectPaging($this->p,$total_page);
        $offset  = (($this->p - 1) * $this->Data['page_limited']);
        $params  = array(
                    'limit'  => $this->Data['page_limited'],
                    'offset' => $offset,
                   );

        $reports = $service->getAllReportWithInfo($params);
        $this->Data['reports'] = $reports;

        return 'report/index.php';
    }
}
