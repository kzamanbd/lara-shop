<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Electronics - Featured & Best Selling
        Product::create([
            'name' => 'Apple MacBook Pro 16" (2023)',
            'slug' => 'apple-macbook-pro-16-2023-m3-chip',
            'category_id' => '1',
            'product_price' => '249999',
            'sale_price' => '239999',
            'product_color' => 'space-gray',
            'alert_quantity' => '2',
            'quantity' => '15',
            'description' => '<p>Apple MacBook Pro 16" with M3 chip, 18GB RAM, 512GB SSD. Perfect for professionals and creative work. Features stunning Liquid Retina XDR display with ProMotion technology.</p>',
            'is_featured' => true,
            'is_best_selling' => true,
        ]);

        // Electronics - New Arrival
        Product::create([
            'name' => 'Samsung Galaxy S24 Ultra',
            'slug' => 'samsung-galaxy-s24-ultra-512gb',
            'category_id' => '2',
            'product_price' => '139999',
            'sale_price' => '134999',
            'product_color' => 'titanium-black',
            'alert_quantity' => '3',
            'quantity' => '25',
            'description' => '<p>Latest Samsung Galaxy S24 Ultra with 512GB storage, 12GB RAM, S Pen included. Features advanced AI photography and 200MP main camera.</p>',
            'is_new_arrival' => true,
            'is_featured' => true,
        ]);

        // Electronics - Special Offer
        Product::create([
            'name' => 'iPhone 15 Pro',
            'slug' => 'iphone-15-pro-128gb',
            'category_id' => '2',
            'product_price' => '119999',
            'sale_price' => '109999',
            'product_color' => 'natural-titanium',
            'alert_quantity' => '2',
            'quantity' => '20',
            'description' => '<p>iPhone 15 Pro with A17 Pro chip, 128GB storage, titanium design. Features Action Button and enhanced camera system with 5x telephoto zoom.</p>',
            'is_special_offer' => true,
            'is_best_selling' => true,
        ]);

        // Accessories - Featured
        Product::create([
            'name' => 'Sony WH-1000XM5 Headphones',
            'slug' => 'sony-wh-1000xm5-noise-cancelling-headphones',
            'category_id' => '3',
            'product_price' => '34999',
            'sale_price' => '32999',
            'product_color' => 'black',
            'alert_quantity' => '1',
            'quantity' => '30',
            'description' => '<p>Industry-leading noise cancelling headphones with 30-hour battery life. Crystal clear hands-free calling and Speak-to-Chat technology.</p>',
            'is_featured' => true,
        ]);

        // Accessories - New Arrival & Special Offer
        Product::create([
            'name' => 'AirPods Pro (3rd Generation)',
            'slug' => 'airpods-pro-3rd-generation-usb-c',
            'category_id' => '3',
            'product_price' => '24999',
            'sale_price' => '22999',
            'product_color' => 'white',
            'alert_quantity' => '2',
            'quantity' => '40',
            'description' => '<p>AirPods Pro with USB-C charging case. Features Adaptive Audio, Personalized Spatial Audio, and up to 6 hours of listening time.</p>',
            'is_new_arrival' => true,
            'is_special_offer' => true,
        ]);

        // Software - Best Selling
        Product::create([
            'name' => 'Microsoft Office 365 Personal',
            'slug' => 'microsoft-office-365-personal-1-year',
            'category_id' => '4',
            'product_price' => '6999',
            'sale_price' => '5999',
            'product_color' => '',
            'alert_quantity' => '1',
            'quantity' => '100',
            'description' => '<p>Microsoft Office 365 Personal 1-year subscription. Includes Word, Excel, PowerPoint, Outlook, and 1TB OneDrive storage.</p>',
            'is_best_selling' => true,
        ]);

        // Software - New Arrival
        Product::create([
            'name' => 'Adobe Creative Cloud All Apps',
            'slug' => 'adobe-creative-cloud-all-apps-annual',
            'category_id' => '4',
            'product_price' => '52999',
            'sale_price' => '49999',
            'product_color' => '',
            'alert_quantity' => '1',
            'quantity' => '50',
            'description' => '<p>Adobe Creative Cloud All Apps annual subscription. Access to Photoshop, Illustrator, Premiere Pro, After Effects, and 20+ creative apps.</p>',
            'is_new_arrival' => true,
            'is_featured' => true,
        ]);

        // Electronics - Gaming - Featured & Best Selling
        Product::create([
            'name' => 'PlayStation 5 Digital Edition',
            'slug' => 'playstation-5-digital-edition-console',
            'category_id' => '1',
            'product_price' => '54999',
            'sale_price' => '52999',
            'product_color' => 'white',
            'alert_quantity' => '1',
            'quantity' => '12',
            'description' => '<p>PlayStation 5 Digital Edition console with custom SSD and DualSense controller. Experience lightning-fast loading and immersive gaming.</p>',
            'is_featured' => true,
            'is_best_selling' => true,
        ]);

        // Electronics - Smart Home - New Arrival
        Product::create([
            'name' => 'Amazon Echo Dot (5th Gen)',
            'slug' => 'amazon-echo-dot-5th-gen-smart-speaker',
            'category_id' => '1',
            'product_price' => '4999',
            'sale_price' => '3999',
            'product_color' => 'charcoal',
            'alert_quantity' => '3',
            'quantity' => '50',
            'description' => '<p>Amazon Echo Dot 5th generation with improved audio, built-in temperature sensor, and Alexa voice control for smart home devices.</p>',
            'is_new_arrival' => true,
        ]);

        // Accessories - Special Offer
        Product::create([
            'name' => 'Logitech MX Master 3S Mouse',
            'slug' => 'logitech-mx-master-3s-wireless-mouse',
            'category_id' => '3',
            'product_price' => '8999',
            'sale_price' => '7499',
            'product_color' => 'graphite',
            'alert_quantity' => '2',
            'quantity' => '35',
            'description' => '<p>Logitech MX Master 3S wireless mouse with ultra-fast scrolling, ergonomic design, and 70-day battery life. Works on glass surfaces.</p>',
            'is_special_offer' => true,
        ]);

        // Mobile Phones - Budget - Best Selling
        Product::create([
            'name' => 'Samsung Galaxy A54 5G',
            'slug' => 'samsung-galaxy-a54-5g-128gb',
            'category_id' => '2',
            'product_price' => '44999',
            'sale_price' => '41999',
            'product_color' => 'awesome-violet',
            'alert_quantity' => '2',
            'quantity' => '45',
            'description' => '<p>Samsung Galaxy A54 5G with 128GB storage, 50MP OIS camera, and 5000mAh battery. Features 120Hz Super AMOLED display.</p>',
            'is_best_selling' => true,
        ]);

        // Electronics - Tablet - Featured
        Product::create([
            'name' => 'iPad Air (5th Generation)',
            'slug' => 'ipad-air-5th-generation-64gb-wifi',
            'category_id' => '1',
            'product_price' => '59999',
            'sale_price' => '56999',
            'product_color' => 'space-gray',
            'alert_quantity' => '2',
            'quantity' => '28',
            'description' => '<p>iPad Air with M1 chip, 64GB storage, 10.9-inch Liquid Retina display. Compatible with Apple Pencil (2nd generation) and Magic Keyboard.</p>',
            'is_featured' => true,
        ]);

        // Accessories - Gaming - New Arrival & Special Offer
        Product::create([
            'name' => 'SteelSeries Arctis 7P+ Wireless Gaming Headset',
            'slug' => 'steelseries-arctis-7p-plus-wireless-gaming-headset',
            'category_id' => '3',
            'product_price' => '16999',
            'sale_price' => '14999',
            'product_color' => 'black',
            'alert_quantity' => '1',
            'quantity' => '20',
            'description' => '<p>SteelSeries Arctis 7P+ wireless gaming headset with lossless 2.4GHz wireless, 30-hour battery life, and Discord-certified microphone.</p>',
            'is_new_arrival' => true,
            'is_special_offer' => true,
        ]);

        // Electronics - Smartwatch - Featured & New Arrival
        Product::create([
            'name' => 'Apple Watch Series 9 GPS',
            'slug' => 'apple-watch-series-9-gps-45mm',
            'category_id' => '1',
            'product_price' => '42999',
            'sale_price' => '39999',
            'product_color' => 'midnight',
            'alert_quantity' => '2',
            'quantity' => '25',
            'description' => '<p>Apple Watch Series 9 with S9 chip, 45mm case, Always-On Retina display, and advanced health monitoring features including ECG and Blood Oxygen.</p>',
            'is_featured' => true,
            'is_new_arrival' => true,
        ]);

        // Software - Productivity - Special Offer
        Product::create([
            'name' => 'Canva Pro Annual Subscription',
            'slug' => 'canva-pro-annual-subscription',
            'category_id' => '4',
            'product_price' => '12999',
            'sale_price' => '9999',
            'product_color' => '',
            'alert_quantity' => '1',
            'quantity' => '200',
            'description' => '<p>Canva Pro annual subscription with premium templates, brand kit, background remover, and team collaboration features.</p>',
            'is_special_offer' => true,
        ]);

        // Electronics - Camera - Best Selling & Featured
        Product::create([
            'name' => 'Canon EOS R8 Mirrorless Camera',
            'slug' => 'canon-eos-r8-mirrorless-camera-body',
            'category_id' => '1',
            'product_price' => '149999',
            'sale_price' => '139999',
            'product_color' => 'black',
            'alert_quantity' => '1',
            'quantity' => '8',
            'description' => '<p>Canon EOS R8 full-frame mirrorless camera with 24.2MP sensor, 4K video recording, and advanced autofocus system. Body only.</p>',
            'is_best_selling' => true,
            'is_featured' => true,
        ]);

        // Accessories - Storage - New Arrival
        Product::create([
            'name' => 'Samsung T7 Portable SSD 1TB',
            'slug' => 'samsung-t7-portable-ssd-1tb-usb-3-2',
            'category_id' => '3',
            'product_price' => '12999',
            'sale_price' => '11999',
            'product_color' => 'titan-gray',
            'alert_quantity' => '2',
            'quantity' => '40',
            'description' => '<p>Samsung T7 portable SSD with 1TB storage, USB 3.2 Gen 2 interface, and transfer speeds up to 1,050 MB/s. Password protection and AES 256-bit encryption.</p>',
            'is_new_arrival' => true,
        ]);

        // Electronics - Monitor - Special Offer
        Product::create([
            'name' => 'Dell UltraSharp 27" 4K Monitor',
            'slug' => 'dell-ultrasharp-27-4k-usb-c-monitor',
            'category_id' => '1',
            'product_price' => '54999',
            'sale_price' => '47999',
            'product_color' => 'silver',
            'alert_quantity' => '1',
            'quantity' => '15',
            'description' => '<p>Dell UltraSharp 27" 4K monitor with IPS panel, 99% sRGB color coverage, USB-C connectivity, and built-in KVM switch.</p>',
            'is_special_offer' => true,
        ]);

        // Mobile Phones - Flagship - Featured
        Product::create([
            'name' => 'Google Pixel 8 Pro',
            'slug' => 'google-pixel-8-pro-128gb',
            'category_id' => '2',
            'product_price' => '99999',
            'sale_price' => '94999',
            'product_color' => 'obsidian',
            'alert_quantity' => '2',
            'quantity' => '18',
            'description' => '<p>Google Pixel 8 Pro with Google Tensor G3 chip, 128GB storage, AI-powered camera features, and 7 years of OS updates.</p>',
            'is_featured' => true,
        ]);

        // Accessories - Charging - Best Selling
        Product::create([
            'name' => 'Anker PowerCore 10000 Power Bank',
            'slug' => 'anker-powercore-10000-portable-charger',
            'category_id' => '3',
            'product_price' => '2999',
            'sale_price' => '2499',
            'product_color' => 'black',
            'alert_quantity' => '5',
            'quantity' => '100',
            'description' => '<p>Anker PowerCore 10000 portable charger with high-speed charging, PowerIQ technology, and compact design. Charges iPhone 8 almost 4 times.</p>',
            'is_best_selling' => true,
        ]);
    }
}
