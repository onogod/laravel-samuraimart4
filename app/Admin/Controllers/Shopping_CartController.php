<?php

namespace App\Admin\Controllers;

use App\Models\Shopping_Cart;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class Shopping_CartController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shopping_Cart';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shopping_Cart());

   /*     $grid->column('identifier', __('Identifier'));
        $grid->column('instance', __('Instance'));
        $grid->column('content', __('Content'));
        $grid->column('number', __('Number'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('buy_flag', __('Buy flag'));
        $grid->column('code', __('Code'));
        $grid->column('price_total', __('Price total'));
        $grid->column('qty', __('Qty')); */
        $grid->column('identifier', __('ID'))->sortable();
        $grid->column('instance', __('User ID'))->sortable();
        $grid->column('price_total', __('Price total'))->totalRow();
        $grid->column('qty', __('Qty'))->totalRaw();
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();
        
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->equal('identifier', 'ID');
            $filter->equal('instance', 'User ID');
            $filter->between('created_at', '登録日')->datetime();
        });
        $grid->disableCreateButton();
        $grid->actions(function ($actions){
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        }); 

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
  /*  protected function detail($id)
    {
        $show = new Show(Shopping_Cart::findOrFail($id));

        $show->field('identifier', __('Identifier'));
        $show->field('instance', __('Instance'));
        $show->field('content', __('Content'));
        $show->field('number', __('Number'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('buy_flag', __('Buy flag'));
        $show->field('code', __('Code'));
        $show->field('price_total', __('Price total'));
        $show->field('qty', __('Qty'));

        return $show;
    } */

    /**
     * Make a form builder.
     *
     * @return Form
     */
/*    protected function form()
    {
        $form = new Form(new Shopping_Cart());

        $form->text('identifier', __('Identifier'));
        $form->text('instance', __('Instance'));
        $form->textarea('content', __('Content'));
        $form->number('number', __('Number'));
        $form->switch('buy_flag', __('Buy flag'));
        $form->text('code', __('Code'));
        $form->number('price_total', __('Price total'));
        $form->number('qty', __('Qty'));

        return $form;
    } */
}
