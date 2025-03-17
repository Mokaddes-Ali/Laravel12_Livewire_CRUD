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


    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:200|dimensions:width=300,height=300',
        'price' => 'required|numeric|min:0',
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
            $this->imagePreview = $this->image->temporaryUrl(); // ইমেজ প্রিভিউ তৈরি
        }
    }


    public function save()
    {
        $this->validate();

        // ইউনিক নাম তৈরি (User ID + Timestamp + Original Filename)
        $imagePath = null;
        if ($this->image) {
            $uniqueName = Auth::id() . '_' . time() . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('courses', $uniqueName, 'public');
        }

        // ডাটাবেজে ইনসার্ট
        $course = Course::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
            'price' => $this->price,
            'user_id' => Auth::id(),
            'creator' => Auth::id(),
        ]);

        if ($course) {
            session()->flash('message', 'Course created successfully.');
        }

        $this->reset(['name', 'description', 'image', 'price']);
    }

    public function render()
    {
        return view('livewire.course.create-course');
    }
}
