<?php
/**
 * Sawasdee, a number translator to Thai reading words
 *
 * Sawasdee is a PHP library that created for people who need to translate numbers to Thai reading style.
 * It's including with Thai currency, Date and Time, Thai Unit and also included Thai SEO URL. Sawasdee
 * comes with easy to use PHP style and powerful with documentation. You will love to use it permanently.
 *
 * @copyright  2015 Bundit Nuntates
 * @license    http://www.opensource.org/licenses/mit-license.php   MIT license
 * @version    Release: 1.1
 * @link       http://devded.com, https://github.com/silkyland
 * @since      0.1
 */
namespace Silkyland;

/**
 * Class Sawasdee
 * @package Silkyland\Sawasdee
 * @author Bundit Nuntates <silkyland@gmail.com>
 */
class Sawasdee
{
    /**
     * @function toThaiDatetime
     * Input some date and time that you need to convert to Thai reading style.
     * @param $date_input
     * @param bool|false $format
     * @param bool|false $short_month
     * @param bool|false $thai_numberic
     * @param bool|true $buddhist_year
     * @return mixed
     */
    public static function toThaiDateTime($date_input, $format = false, $short_month = false, $thai_numberic = false, $buddhist_year = true)
    {
        $year = date('Y', strtotime($date_input));
        $month = date('n', strtotime($date_input));
        $date = date('j', strtotime($date_input));
        $hour = date('H', strtotime($date_input));
        $minute = date('i', strtotime($date_input));
        $second = date('s', strtotime($date_input));

        $numberic_in_thai = ['๐', '๑', '๒', '๓', '๔', '๕', '๖', '๗', '๘', '๙'];

        $numberic_in_arabic = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $thai_full_month = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
        $thai_short_month = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];

        $year = $buddhist_year == true ? ($year + 543) : $year;
        $month_type = $short_month == false ? $thai_full_month[$month] : $thai_short_month[$month];
        $format = $format == false ? '%d%m%y %hนาฬิกา%iนาที%sวินาที' : $format;
        $letters = ['%d', '%m', '%y', '%h', '%i', '%s'];
        $words = [$date, $month_type, $year, $hour, $minute, $second];
        $result = str_replace($letters, $words, $format);
        return $thai_numberic == true ? str_replace($numberic_in_arabic, $numberic_in_thai, $result) : $result;
    }

    /**
     * @param $currency
     * @return string
     */
    public static function readThaiCurrency($currency)
    {
        $exploded = explode('.', $currency);
        if (count($exploded) > 1 and $exploded[1] != 0) {
            $txt = SELF::readThaiNumber($exploded[0]) . 'บาท' . SELF::readThaiNumber($exploded[1]) . 'สตางค์';
        } else {
            $txt = SELF::readThaiNumber($exploded[0]) . 'บาทถ้วน';
        }
        return $txt;
    }

    /**
     * @param $unit
     * @return string
     */
    public static function readThaiUnit($unit)
    {
        $number_count_thai = ["ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า"];
        $number = str_split("0123456789");
        $exploded = explode('.', $unit);
        print_r($number);
        if (count($exploded) > 1) {
            $txt = SELF::readThaiNumber($exploded[0]) . 'จุด' . str_replace($number, $number_count_thai, $exploded[1]);
        } else {
            $txt = SELF::readThaiNumber($unit);
        }
        return $txt;
    }

    /**
     * @param $number
     * @return string
     */
    public static function readThaiNumber($number)
    {
        if ($number == 0) {
            return "ศูนย์";
        } else {
            $number_group = array_map('strrev', array_reverse(str_split(strrev("$number"), 6)));
            $position_thai = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];
            $number_count_thai = ["", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า"];
            $txt = "";
            for ($i = 0; $i < count($number_group); $i++) {
                $data = str_split($number_group[$i]);
                $find = strlen($number_group[$i]);
                for ($len = 0; $len < strlen($number_group[$i]); $len++) {
                    if (($find - 1) == 1 and $data[$len] == 2) {
                        $txt .= 'ยี่' . $position_thai[$find - 1];
                    } elseif (($find - 1) == 1 and $data[$len] == 1) {
                        $txt .= $position_thai[$find - 1];
                    } elseif (($find - 1) == 0 and ($data[$len] == 1) and strlen($number_group[$i]) > 1 and $data[$len - 1] != 0) {
                        $txt .= 'เอ็ด' . $position_thai[$find - 1];
                    } else {
                        $txt .= $data[$len] == 0 ? $number_count_thai[$data[$len]] : $number_count_thai[$data[$len]] . $position_thai[$find - 1];
                    }
                    $find--;
                }
                $txt .= $i + 1 != count($number_group) ? 'ล้าน' : '';
            }
            return $txt;
        }
    }

    /**
     * @param $string
     * @return string
     */
    public static function toThaiURL($string)
    {
        $string = preg_replace("`\[.*\]`U", "", $string);
        $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
        $string = str_replace('%', '-percent', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo|ldquo|rdquo);`i", "\\1", $string);
        $string = preg_replace(array("`[^a-z0-9ก-๙เ-า]`i", "`[-]+`"), "-", $string);
        $string = str_replace('-ldquo', '', $string);
        $string = str_replace('-rdquo', '', $string);
        return strtolower(trim($string, '-'));
    }
}
