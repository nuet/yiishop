<?php
/**
 * 权限角色管理
 */
class XAdminiAcl
{
    //权限配制数据
    public static $aclList = array(
        'order'=>array(
            'name'=>'订单',
            'ctl'=>array(
                array(
                    'name'=>'订单列表',
                    'list_ctl'=>array('default'),
                    'act'=>array(
                        'default'=>array(
                            'name'=>'订单',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'订单列表','update'=>'订单编辑','delete'=>'删除订单')
                        ),
                    )
                )
            )
        ),
        'goods'=>array(
            'name'=>'商品',
            'ctl'=>array(
                array(
                    'name'=>'商品管理',
                    'list_ctl'=>array('default'),
                    'act'=>array(
                        'default'=>array(
                            'name'=>'商品列表',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'商品列表')
                        ),
                    )
                ),
                array(
                    'name'=>'商品配置',
                    'list_ctl'=>array('cat','brand','spec','type','props'),
                    'act'=>array(
                        'cat'=>array(
                            'name'=>'商品分类',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'分类列表')
                        ),
                        'type'=>array(
                            'name'=>'商品类型',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'类型列表')
                        ),
                        'brand'=>array(
                            'name'=>'商品品牌',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'品牌列表')
                        ),
                        'spec'=>array(
                            'name'=>'商品规格',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'规格列表')
                        ),
                        'props'=>array(
                            'name'=>'商品扩展属性',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'扩展属性列表')
                        ),
                    ),
                ),
            )
        ),

        'desktop'=>array(
            'name'=>'系统',
            'ctl'=>array(
                array(
                    'name'=>'管理员和权限',
                    'list_ctl'=>array('role','user'),
                    'act'=>array(
                        'role'=>array(
                            'name'=>'角色管理',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'角色列表','update'=>'角色编辑')
                        ),
                        'user'=>array(
                            'name'=>'操作员管理',
                            'default_id'=>'index',
                            'list_act'=>array('index'=>'操作员列表')
                        ),
                    )
                )
            )
        ),

    );

    /**
     * 后台菜单过滤
     *
     */
    static public function filterMenu($acl_list,$super)
    {
        $item = self::$aclList;
        if ($super == 1) return $item;
        foreach ($item as $k=>$v) {
            foreach ($v['ctl'] as $kk=>$vv) {
                foreach ($vv['act'] as $kkk=>$vvv) {
                    $acl = $k.'_'.$kkk.'_'.$vvv['default_id'];
                    if (!in_array($acl,$acl_list)) {
                        unset($item[$k]['ctl'][$kk]['act'][$kkk]);
                    }
                }
                if (empty($item[$k]['ctl'][$kk]['act'])) unset($item[$k]['ctl'][$kk]);
            }
            if (empty($item[$k]['ctl'])) unset($item[$k]);
        }
        return $item;
    }

    /**
     * 系统角色管理
     *
     * @return array
     */
    public static function RoleMenu()
    {
        return self::$aclList;
    }
}

