<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FieldController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255|unique:fields',
                'description' => 'nullable|string'
            ]);

            // Tự động tạo slug từ tên
            $slug = Str::slug($request->name);

            $field = new Field();
            $field->name = $request->name;
            $field->slug = $slug;
            $field->description = $request->description;
            $field->status = 1;
            $field->save();

            DB::commit();

            Log::info('Field created successfully', ['field' => $field]);

            return response()->json([
                'id' => $field->id,
                'name' => $field->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error creating field', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'error' => 'Có lỗi xảy ra khi thêm lĩnh vực: ' . $e->getMessage()
            ], 500);
        }
    }
}
