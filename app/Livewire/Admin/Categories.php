<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\ParentCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $pcategory_id,$pcategory_name;
    public $category_id,$parent = "";
    public $category_name;
    public $pcategoriesPerPage = 2;
    public $categoriesPerPage = 3;
    public $isUpdateParentCategoryMode,$isUpdateCategoryMode = false;
    protected $listeners = [
        "deleteParentCategoryAction",
        "deleteCategoryAction",
    ];
    function addParentCategory() {
        $this->pcategory_id = null;
        $this->pcategory_name = null;
        $this->isUpdateParentCategoryMode = false;
        $this->showParentCategoryModalForm();
    }

    function addCategory() {
        $this->category_id = null;
        $this->parent = "";
        $this->category_name = null;
        $this->isUpdateCategoryMode = false;
        $this->showCategoryModalForm();

    }



    function deleteParentCategory($id) {
        $this->dispatch("deleteParentCategory",["id" => $id]);
    }

    
    function deleteCategory($id) {
        $this->dispatch("deleteCategory",["id" => $id]);
    }

    function deleteParentCategoryAction($id) {
        $pcategory = ParentCategory::findOrFail($id);
        if ($pcategory->hasCategories->count() > 0) {
            foreach ($pcategory->hasCategories as $item) {
                Category::where("id",$item->id)->update(["parent" => null]);
            }
        }
        $deleted = $pcategory->delete();
        if ($deleted) {
            $this->dispatch("showToastr", 
            type:"success",
            message: "Xóa danh mục thành công"
            );
        } else {
            $this->dispatch("showToastr", 
            type:"error",
            message: "Xóa danh mục thất bại"
            );
        }
    }

    function deleteCategoryAction($id) {
        $category = Category::findOrFail($id);
        if ($category->posts->count() > 0 ) {
            $count = $category->posts->count();
             $this->dispatch("showToastr", 
                type:"error",
                message: "Danh mục này đang có {$count} bài viết liên quan. Bạn không thể xóa"
                );
            return;
        } 
        $deleted = $category->delete();
        if ($deleted)
            $this->dispatch("showToastr", 
            type:"success",
            message: "Xóa danh mục thành công"
            );
    }

    function showParentCategoryModalForm() {
        $this->resetErrorBag();
        $this->dispatch("showParentCategoryModalForm");
    }

    function showCategoryModalForm() {
        $this->resetErrorBag();
        $this->dispatch("showCategoryModalForm");
    }

    function hideParentCategoryModalForm() {
        $this->dispatch("hideParentCategoryModalForm");
        $this->isUpdateParentCategoryMode = false;
    }

    function hideCategoryModalForm() {
        $this->dispatch("hideCategoryModalForm");
        $this->isUpdateCategoryMode = false;
        $this->category_id = $this->category_name = null;
        $this->parent = "";
    }

    function createParentCategory() {
        $this->validate([
            "pcategory_name" => "required|unique:parent_categories,name"
        ],[
            "pcategory_name.required"=> "Parent category field is required",
            "pcategory_name.unique" => "Parent category name is already exists"
        ]);
        $pcategory = new ParentCategory();
        $pcategory->name = $this->pcategory_name;
        $saved = $pcategory->save();
        if ($saved) {
            $this->hideParentCategoryModalForm();
            $this->dispatch("showToastr", type: "success", message: "Thêm danh mục cha thành công");
        } else {
            $this->dispatch("showToastr", [
            "type" => "error",
            "message" => "Something went wrong"
            ]);
        }
    }

    function createCategory() {
        $this->validate([
            "category_name" => "required|unique:categories,name"
        ],[
            "category_name.required" => "Vui lòng nhập tên danh mục",
            "category_name.unique" => "Tên danh mục đã tồn tại"
        ]);
        $category = new Category();
        $category->parent = ($this->parent == "") ? null : $this->parent;
        $category->name = $this->category_name;
        $saved = $category->save();
        if ($saved) {
            $this->hideCategoryModalForm();
            $this->dispatch("showToastr", type:"success", message: "Tạo danh mục thành công");
        } else {
            $this->dispatch("showToastr", [
            "type" => "error",
            "message" => "Something went wrong"
            ]);
        }
    }

    function editParentCategory($id) {
        $pcategory = ParentCategory::findOrFail($id);
        $this->pcategory_id = $pcategory->id;
        $this->pcategory_name = $pcategory->name;
        $this->isUpdateParentCategoryMode = true;
        $this->showParentCategoryModalForm();
    }

    function editCategory($id) {
        $category = Category::findOrFail($id);
        $this->category_id = $category->id;
        $category->parent = ($this->parent == "" ) ? null : $this->parent;
        $this->category_name = $category->name;
        $this->isUpdateCategoryMode = true;
        $this->showCategoryModalForm();
    }

    function updateParentCategory() {
        $pcategory = ParentCategory::findOrFail($this->pcategory_id);
        $this->validate([
            "pcategory_name" => "required|unique:parent_categories,name," . $pcategory->name
        ],[
            "pcategory_name.required" => "Vui lòng nhập tên danh mục",
            "pcategory_name.unique" => "Tên danh mục đã tồn tại"
        ]);
        $pcategory->name = $this->pcategory_name;
        $pcategory->slug = null;
        $updated = $pcategory->save();
        if ($updated) {
            $this->hideParentCategoryModalForm();
            $this->dispatch("showToastr", type: "success", message: "Cập nhật danh mục thành công");
        } else {
            $this->dispatch("showToastr", [
            "type" => "error",
            "message" => "Cập nhật thất bại"
            ]);
        }
    }

    function updateCategory() {
        $category = Category::findOrFail($this->category_id);
        $this->validate([
            "category_name" => "required|unique:categories,name,".$category->id
        ],[
            "category_name.required" => "Vui lòng nhập tên danh mục",
            "category_name.unique" => "Tên danh mục đã tồn tại"
        ]);
        $category->name = $this->category_name;
        $category->parent = $this->parent;
        $category->slug = null;
        $updated = $category->save();
        if ($updated) {
            $this->hideCategoryModalForm();
            $this->dispatch("showToastr", type: "success", message: "Danh mục đã được cập nhật thành công");
        } else {
                $this->dispatch("showToastr", type: "error", message: "Danh mục cập nhật thất bại");
        }
    }


    public function render()
    {
        return view('livewire.admin.categories',[
            "pcategories" => ParentCategory::orderBy("created_at","asc")->get(),
            "categories" => Category::orderBy("created_at","asc")->get(),
        ]);
    }
}
