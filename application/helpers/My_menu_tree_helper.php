<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 14-Mar-16
 * Time: 4:34 PM
 */

class My_menu_tree_helper{
    public static function get_tree_menu() {
        $CI =& get_instance();
        $CI->load->model('task_manage_model');
        $tasks = $CI->task_manage_model->get_all_tasks();
        $menu_tree = self::create_menu_tree($tasks);
        self::print_tree_menu($menu_tree);
    }

    public static function print_tree_menu($tasks, $self = false) {
        $CI =& get_instance();

        foreach ($tasks as $task)
        {
            if (empty($task['sub_menu']))
            {
                $a_class = '';
                if (strtolower($CI->router->fetch_class()) == strtolower($task['controller'])
                    && strtolower($CI->router->fetch_method()) == strtolower($task['method'])
                ) {
                    $a_class = 'active open_parent';
                }
                ?>
                <li class="<?php echo $a_class; ?>">
                    <a href="<?php echo base_url().$task['controller'].'/'.$task['method'];?><?php //Router::url(['controller' => $task['controller'], 'action' => $task['method']]); ?>">
                        <i class="<?php echo  $task['icon'] ?>"></i> <?php echo $task['name_en'] ?>
                    </a>
                </li>
                <?php
            }
            else
            {
                ?>
                <li>
                    <a href="javascript:;">
                        <i class="<?= $task['icon'] ?>"></i> <?= $task['name_en'] ?> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php
                        self::print_tree_menu($task['sub_menu'], true)
                        ?>
                    </ul>
                </li>
                <?php
            }
            ?>

            <script>
                $(function(){
                    $("li.open_parent").parentsUntil("div").closest("li").addClass('active');
                });
            </script>




            <?php
        }
        if ($self) {
            return 0;
        }

    }


    public static function create_menu_tree($rows, $parent_id = 0) {
        $arrange_menus = [];
        $i = 0;
        foreach ($rows as $row) {
            $i++;
            if ($row['parent_id'] == $parent_id) {
                $children = self::create_menu_tree($rows, $row['id']);
                if ($children) {
                    $row['sub_menu'] = $children;
                    $arrange_menus[] = $row;
                } else {
                    $arrange_menus[] = $row;
                }
            }
        }
        return $arrange_menus;
    }

    public static function page_breadcrumb()
    {
        $CI =& get_instance();
        $html=$CI->load->view('navigation/page_breadcrumb','',true);
        return false;//$html;
    }

    public static function page_access_button_new($button_name='')
    {
        $CI =& get_instance();
        if(empty($button_name))
        {
            $data['button_name']=$CI->lang->line('NEW');
        }
        else
        {
            $data['button_name']=$button_name;
        }
        $html=$CI->load->view('navigation/page_access_button_new',$data,true);
        return $html;
    }

    public static function page_access_button_save()
    {
        $CI =& get_instance();
        $html=$CI->load->view('navigation/page_access_button_save','',true);
        return $html;
    }

    public static function page_access_button_update()
    {
        $CI =& get_instance();
        $html=$CI->load->view('navigation/page_access_button_update','',true);
        return $html;
    }

}




















//
//
//
//if (!function_exists('helper_test')) {
//    function helper_test( ) {
//        return 'success';
//    }
//
//}
//
//if (!function_exists('menu_tree_generator')) {
//    function menu_tree_generator() {
//        $all_tasks = $this->task_manage_library->get_all_tasks();
//        var_dump($all_tasks);
//        exit;
//        $flag = 1;
//        $new_task_tree = array();
//        while ($flag) {
//            foreach ($all_tasks as $task) {
//                $new_task_tree[$task['parent_id']] = $task;
//            }
//            $flag = 0;
//            $all_tasks = $new_task_tree;
//            foreach ($new_task_tree as $task) {
//                if ($task['parent_id'] == 0) {
//                    $flag = 0;
//                    break;
//                }
//            }
//        }
//
//    }
//}
//








