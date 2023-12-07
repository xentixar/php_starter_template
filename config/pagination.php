<?php

class Pagination
{
    protected $table;
    protected $limit;
    protected $data;
    protected $page = 0;
    protected $max_page;

    public function __construct(array $data, int $limit = 10)
    {
        $this->limit = $limit;
        $this->data = $data;
        $this->max_page = ceil(count($this->data) / (int) $this->limit);
    }

    private function get_page_no()
    {
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'] ?? 1;
        } else {
            $this->page = 1;
        }
    }

    private function split_data()
    {
        $offset = ($this->page - 1) * $this->limit;
        $splited_data = array_slice($this->data, $offset, $this->limit);
        return $splited_data;
    }

    public function paginate(): array
    {
        $this->get_page_no();
        $data = $this->split_data();
        return $data;
    }

    public function links()
    {
        if ($this->page == 0) {
            throw new Error('You can\'t use links method until you have paginated the data!');
        }
        if ($this->max_page > 1) {
            $links = '';
            $current_page = $this->page;
            for ($i = (($current_page - 4) >= 1 ? $current_page - 4 : 1); $i <= (($current_page + 4) <= $this->max_page ? $current_page + 4 : $this->max_page); $i++) {
                $status = ($i == $this->page ? 'active' : '');
                $links .= "<li class='page-item $status'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
            $previous_page = $this->page - 1;
            $previous_page_status = $this->page == 1 ? 'disabled' : '';
            $next_page = $this->page  + 1;
            $next_page_status = $this->page == $this->max_page ? 'disabled' : '';
            echo "<nav aria-label='Page navigation example'>
            <ul class='pagination justify-content-end my-3' style='flex-wrap:wrap'>
                <li class='page-item $previous_page_status'>
                    <a class='page-link' href='?page=$previous_page' tabindex='-1' aria-disabled='true'>Previous</a>
                </li>
                $links
                <li class='page-item $next_page_status'>
                    <a class='page-link' href='?page=$next_page'>Next</a>
                </li>
            </ul>
        </nav>";
        }
    }
}
