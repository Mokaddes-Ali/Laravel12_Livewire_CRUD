<?php

namespace App\Livewire\Course;

use Livewire\Component;
use App\Models\Course;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class CreateCourse extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $image;
    public $price;
    public $imagePreview;
    public $oldImage;
    public $is_active;
    public $isEdit = false;
    public $productId;

    public function mount($productId = null)
    {
        if ($productId) {
            // If product ID is passed, edit mode will be activated
            $this->isEdit = true;
            $this->loadProduct($productId);
        }
    }

    public function loadProduct($productId)
    {
        $product = Course::find($productId);
    if ($product) {
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->is_active = $product->is_active; // Load active status
        $this->oldImage = $product->image; // Save existing image
    }
 else {
    session()->flash('error', 'Course not found.');
    redirect()->route('course.index');
}
}

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:200|dimensions:width=300,height=300',
        'price' => 'required|numeric|min:0',
        'is_active' => 'required|in:0,1',
    ];

    protected $messages = [
        'image.required' => 'The image field is required.',
        'image.image' => 'The uploaded file must be an image.',
        'image.mimes' => 'Only JPEG, PNG, and JPG images are allowed.',
        'image.max' => 'The image size must not exceed 200KB.',
        'image.dimensions' => 'The image must be exactly 300x300 pixels.',
    ];


    public function updatedImage()
    {
        $this->validateOnly('image');

        if ($this->image) {
            $this->imagePreview = $this->image->temporaryUrl();
        }
    }

    public function updatedIsActive($value)
{
    $this->is_active = $value ? 1 : 0;
}

public function updatedIsInactive($value)
{
    $this->is_active = $value ? 0 : 1;
}

    public function save()
    {
        $this->validate();

        // Handle image upload (if any)
        $imagePath = null;
        if ($this->image) {
            $uniqueName = Auth::id() . '_' . time() . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('courses', $uniqueName, 'public');
        } else {
            $imagePath = $this->oldImage;
        }

        if ($this->isEdit) {
            $course = Course::find($this->productId);
            $course->update([
                'name' => $this->name,
                'description' => $this->description,
                'image' => $imagePath,
                'price' => $this->price,
                'is_active' => $this->is_active,
                'editor' => Auth::id(),
            ]);
        } else {
            $course = Course::create([
                'name' => $this->name,
                'description' => $this->description,
                'image' => $imagePath,
                'price' => $this->price,
                'user_id' => Auth::id(),
                'creator' => Auth::id(),
                'is_active' => $this->is_active,
            ]);
        }

        if ($course) {
            session()->flash('message', $this->isEdit ? 'Course updated successfully.' : 'Course created successfully.');
            // return redirect()->route('course.index');
            return redirect()->back();
        }

        $this->reset(['name', 'description', 'image', 'price', 'is_active']);
    }
    public function render()
    {
        return view('livewire.course.create-course');
    }
}
