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
        Product::create([
            'name' => 'Apple Macbook Air (2017) i5',
            'slug' => 'apple-macbook-air-2017-dual-core-intel-core-i5-macbook',
            'category_id' => '1',
            'product_price' => '83000',
            'sale_price' => '82000',
            'product_color' => 'white',
            'alert_quantity' => '1',
            'quantity' => '10',
            'description' => '<p>Processor - Dual Core Intel Core i5<br>Processor Clock Speed - 1.8-2.9GHz<br>Display Size - 13.3"<br>RAM - 8GB<br>HDD - 128GB SSD (PCIe Onboard)<br>Operating System - mac OS Sierra<br>Product Region: USA<br></p>',
            'image' => 'default.jpg',
        ]);

        Product::create([
            'name' => 'Apple iPhone 6S',
            'slug' => 'apple-iphone-6s',
            'category_id' => '2',
            'product_price' => '35999',
            'sale_price' => '34999',
            'product_color' => 'grey',
            'alert_quantity' => '1',
            'quantity' => '10',
            'description' => '<table class="wp-block-table" style="padding: 0px; margin: 0px 0px 1.5em; list-style: none; border: 0px; outline: none; width: 915px; min-width: 240px; color: rgb(44, 47, 52); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, &quot;Open Sans&quot;, Arial, sans-serif; font-size: 15px; background-color: rgb(255, 255, 255);"><tbody style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;"><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Network</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">2G, 3G, 4G</td></tr><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none; background: rgba(0, 0, 0, 0.03);"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Battery</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Lithium-polymer 1715 mAh (non-removable)<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">Stand-by: up to 240 hours (3G)<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">Talk-time: up to 14 hours (3G)</td></tr><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Body</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">138.3 x 67.1 x 7.1 millimeter, 143 grams</td></tr><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none; background: rgba(0, 0, 0, 0.03);"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Camera (Back)</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">12 Megapixel<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">– PDAF, dual-LED flash, face &amp; smile detection,<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">simultaneous 4K video and 8MP image recording, panorama, HDR, iSight, 1.22µ pixels, ƒ/2.2, image stabilization<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">– Ultra HD 4K (2160p) video rec. with cinematic video stabilization, autofocus, face detection</td></tr><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Camera (Front)</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">5 Megapixel<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">– Auto face recognition, HDR, ƒ/2.2 aperture, Retina flash<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">– HD (720p) video rec.</td></tr><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none; background: rgba(0, 0, 0, 0.03);"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Chipset</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Apple A9</td></tr><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Colors</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Space Gray, Silver, Gold, Rose Gold</td></tr><tr style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none; background: rgba(0, 0, 0, 0.03);"><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">Display</td><td style="padding: 0.5em; margin: 0px; list-style: none; border: 1px solid rgba(0, 0, 0, 0.1); outline: none; word-break: keep-all; overflow-wrap: normal;">4.7 inches, Retina HD 750 x 1334 pixels (326 ppi)<br style="padding: 0px; margin: 0px; list-style: none; border: 0px; outline: none;">– LED-backlit IPS LCD 3D-Touch screen, ion-strengthened glass &amp; oleophobic coating protection</td></tr></tbody></table>',
            'image' => 'default.jpg',
        ]);

        Product::create([
            'name' => 'Apple USB-C Digital AV Multiport Adapter',
            'slug' => 'apple-usb-c-digital-av-multiport-adapter-usb-c-to-hdmi-usb-usb-c',
            'category_id' => '3',
            'product_price' => '6500',
            'sale_price' => ' 6000',
            'product_color' => 'white',
            'alert_quantity' => '1',
            'quantity' => '10',
            'description' => '<p><span style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;; font-size: 12px;">Model - Apple USB-C Digital AV Multiport</span><br style="margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;; font-size: 12px; outline: 0px !important;"><span style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;; font-size: 12px;">Type - USB-C Digital AV Multiport Adapter</span><br style="margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;; font-size: 12px; outline: 0px !important;"><span style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;; font-size: 12px;">Length - Mini</span><br></p>',
            'image' => 'default.jpg',
        ]);


        Product::create([
            'name' => 'Bijoy Bayanno Software',
            'slug' => 'bijoy-bayanno-bangla-typing-software',
            'category_id' => '4',
            'product_price' => '250',
            'sale_price' => ' 200',
            'product_color' => '',
            'alert_quantity' => '1',
            'quantity' => '10',
            'description' => '<p style="margin-bottom: 0.5em; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;">We have done a lot of work on computers that need to be written in English as well as Bengali. And Bijoy Bayanno 2019 free download is the most popular software to write this Bangla. The important aspect is that it can be written directly with the Unicode. The option can be changed with non-Unicode or ASCII.&nbsp;Anyone can be written directly through the Unicode on the internet, which was never possible before without&nbsp;<a href="https://www.fileour.com/avro-keyboard-standard-version-full-free-download-for-pc/" style="margin: 0px; padding: 0px; color: rgb(0, 176, 200);">Avro Bangla keyboard software</a>. But now you can easily get the Bangla word typing software for using on your computer.</p><p style="margin-bottom: 0.5em; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;">A person may not be able to find someone who does not know about Bijoy 52, the unique software typing in Bangla typing. Most of us started typing Bangla with the Bijoy Keyboard. But the&nbsp;<a href="https://www.fileour.com/bijoy-bayanno-free-download/" style="margin: 0px; padding: 0px; color: rgb(0, 176, 200);">Bijoy Bayanno 2019</a>&nbsp;free download new version&nbsp;of the young generation is still somewhat faded, but if you count them, the number of people who use victory will be much more in number.</p>',
            'image' => 'default.jpg',
        ]);
    }
}
