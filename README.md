# Sawasdee 
Sawasdee, A miscellaneous library for number, words translator to Thai reading style including with Thai currency, date and time, Thai unit and also included Thai SEO URL. Sawasdee comes with easy to use PHP style and powerful with documentation.

##What's Sawasdee can do?
Sawasdee can translate number to Thai words reading style comes with:
* Translate DateTime to Thai DateTime e.g. "08/16/2015" convert to "16 สิงหาคม 2515" or "๑๖ สิงหาคม ๒๕๕๘" or any format you need
* Translate Thai currency e.g. "121.25" convert to "หนึ่งร้อยยี่สิบเอ็ดบาทยี่สิบห้าสตางค์" or input "215" will convert to "สองร้อยสิบห้าบาทถ้วน"
* Translate Thai Unit e.g. "999.99" convert to "เก้าร้อยเก้าสิบเก้าจุดเก้าเก้า"
* Convert word to url style e.g. "Boostrap ครองแชมป์ css framework ที่ดีที่สุด 100%" to "Boostrap-ครองแชมป์-css-framwork-ที่ดีที่สุด-100-เปอร์เซนต์"

##Require
* PHP Version 5.4 or above

##Installation
#####Via composer
Simply add a dependency on silkyland/sawasdee to your project's composer.json file if you use Composer to manage dependencies of your project. You can add code below to your composer.json file.
```json
{
  "require-dev" : {
        "silkyland/sawasdee" : "1.*"
  }
}  
```
Or you can use command-line to add silkyland\sawasdee package too by use this command.
```bash
php composer.phar require "silkyland/sawasdee=1.*"
```
#####Via Download
Download zip file and exact to any folder you need in your project.

#Usage
#####Thai date and time
By using "toThaiDateTime()" function you can input parameter string $date_input, bool $format, bool $short_month, bool $thai_numberic and bool $buddhist_year: 
```php
$sawasdee = new Sawasdee;
```
Basic using it will product default format like "date|month|buddhist year| |hourนาฬิกา|minuteนาที|secondวินาที"
```php
echo $sawasdee->toThaiDateTime('08/17/2015 09:50');  
// 17สิงหาคม2558 9นาฬิกา50นาที00วินาที
```
You can custom format with these words :  %d (date), %m (month), %y (year), %h (hour), %i (minute), %s (second).
```php
echo $sawasdee->toThaiDateTime('08/17/2015 09:50', '%d %m %y');
// 17 สิงหาคม 2558

echo $sawasdee->toThaiDateTime('08/17/2015 09:50', '%hชั่วโมง %iนาที %sวินาที');
// 9ชั่วโมง 5นาที 0วินาที

echo $sawasdee->toThaiDateTime('08/17/2015 09:50', 'เมื่อเวลา %h %m ของวันที่ %d เดือน %m พ.ศ. %y');
// เมื่อเวลา 09:50 ของวันที่ 17 เดือน สิงหาคม พ.ศ. 2558

echo $sawasdee->toThaiDateTime('08/17/2015 09:50', 'ทุกๆวันที่%dของเดือน%mเป็นวันเกิดฉัน');
// ทุกๆวันที่17เดือนสิงหาคมเป็นวันเกิดฉัน

//Or you can use default format by input "false" to second parameter
echo $sawasdee->toThaiDateTime('08/17/2015 09:50', false);
// 17สิงหาคม2558 9นาฬิกา50นาที00วินาที
```
By default short term of Thai month is turn to "false" that mean it will appear month name in full term. If you need a short term you need to use "true" in third parameter like this :
```php
echo $sawasdee->toThaiDateTime('08/17/2015 09:50', '%d %m %y', true);
// 17 ส.ค. 2558
```
If you need Thai alphabet numberic for output number just use "true" in the 4th parameter :
```php
echo $sawasdee->toThaiDateTime('08/17/2015 09:50', '%d %m %y', true, true);
// ๑๗ ส.ค. ๒๕๕๘
```
Because Thailand use buddhist year and Sawasdee turn to buddhist year by default, If you need to change, you can also use "false" for AD (Anno Domini) format :
```php
echo $sawasdee->toThaiDateTime('08/17/2015 09:50', '%d %m %y', true, false, false);
// 17 ส.ค. 2015
```
---
#####Thai currency reading style
To convert number to reading style you need to input number such as "456", 12500021,  or "15.25" and it will return Thai number reading style back. Sure! it also already include "บาท (Bath)" and "สตางค์ (Satang)" in words its return.
```php
echo $sawasdee->readThaiCurrency(0);
// ศูนย์บาท

echo $sawasdee->readThaiCurrency(125);
// หนึ่งร้อยยี่สิบห้าบาทถ้วน

echo $sawasdee->readThaiCurrency(125.00);
// หนึ่งร้อยยี่สิบห้าบาทถ้วน

echo $sawasdee->readThaiCurrency(125.25);
// หนึ่งร้อยยี่สิบห้าบาทยี่สิบห้าสตางค์
```
---
#####Thai unit reading style
In Thai language unit reading such as metre, kilometre, gram, kilogram, celsius etc. Are read different from Thai currency in decimal point. "readThaiUnit()" function is useful to read unit in Thai style.
```php
echo $sawasdee->readThaiUnit(0);
// ศูนย์

echo $sawasdee->readThaiUnit(125);
// หนึ่งร้อยยี่สิบห้า

echo $sawasdee->readThaiUnit(125.00);
// หนึ่งร้อยยี่สิบห้า

echo $sawasdee->readThaiUnit(125.25);
// หนึ่งร้อยยี่สิบห้าจุดสองห้า

echo $sawasdee->readThaiUnit(125.25).' กิโลเมตร';
// หนึ่งร้อยยี่สิบห้าจุดสองห้ากิโลเมตร
```
---
#####Thai URL SEO Friendly
To convert words to url style you need to use toThaiUrl() function
```php
echo $sawasdee->toThaiURL('sawasdee ไลบราลี่ภาษา PHP ที่สามารถใช้งานได้ง่ายที่สุด');
// sawassdee-ไลบราลี่ภาษา-php-ที่สามารถใช้งานได้ง่ายที่สุด

echo 'http://devded.com/'.$sawasdee->toThaiURL('sawasdee ไลบราลี่ภาษา PHP ที่สามารถใช้งานได้ง่ายที่สุด');
// http://devded.com/sawassdee-ไลบราลี่ภาษา-php-ที่สามารถใช้งานได้ง่ายที่สุด

echo 'http://devded.com/'.$sawasdee->toThaiURL('sawasdee ไลบราลี่ภาษา PHP ที่สามารถใช้งานได้ง่ายที่สุด').'html';
// http://devded.com/sawassdee-ไลบราลี่ภาษา-php-ที่สามารถใช้งานได้ง่ายที่สุด.html
```
