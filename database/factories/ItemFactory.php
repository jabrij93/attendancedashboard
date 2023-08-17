<?php

    namespace Database\Factories;

    use App\Models\Item;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
     */
    class ItemFactory extends Factory
    {
        protected $model = Item::class;
        
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition()
        {
            $images = null;

            // Simulate image upload process
            $imageExtensions = ['jpg', 'jpeg', 'png'];
            $randomExtension = $this->faker->randomElement($imageExtensions);
            $imageName = date('YmdHis') . '.' . $randomExtension;
            $images = $imageName;

            return [
                'name' => $this->faker->sentence(1),
                'type_id' => $this->faker->randomElement(['1', '2', '3']),
                'user_id' => $this->faker->randomElement(['1', '2', '3','4','5','6','7','8','9']),
                'images' => $images,
            ];
        }
    }