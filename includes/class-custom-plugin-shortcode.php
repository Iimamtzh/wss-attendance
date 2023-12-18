<?php

/**
 * Class Custom_Plugin_Shortcode
 */
class Custom_Plugin_Shortcode {
    
    /**
     * Custom_Plugin_Shortcode constructor.
     */
    public function __construct() {
        add_shortcode('custom-plugin', array($this, 'custom_plugin_text_shortcode_callback')); // [custom-plugin]
    }

    /**
     * Shortcode callback to display text.
     *
     * @param array $atts Shortcode attributes.
     * @param string $content Shortcode content.
     *
     * @return string
     */
    public function custom_plugin_text_shortcode_callback($atts, $content = null) {
        return '<p>Contoh Output shortcode</p>';
    }
}

// Inisialisasi class Custom_Plugin_Shortcode
new Custom_Plugin_Shortcode();

function display_current_time_12hr() {
    date_default_timezone_set('Asia/Jakarta');

    $format_tanggal_waktu = "h:i A";
    $tanggal_waktu_saat_ini = date($format_tanggal_waktu);

    // Menyusun tag <sup> untuk AM atau PM
    $tag_sup = date('a') === 'am' ? '<sup>AM</sup>' : '<sup>PM</sup>';

    // Menampilkan waktu saat ini dengan tag <sup>
    return str_replace(['AM', 'PM'], [$tag_sup, $tag_sup], $tanggal_waktu_saat_ini);
}
// Menambahkan shortcode dengan nama "current_time_12hr"
add_shortcode('jam', 'display_current_time_12hr');

// Shortcode tanggal
function func_current_date_time_custom_format() {
    date_default_timezone_set('Asia/Jakarta');

    $format_tanggal_waktu = "l - F j, Y";
    $tanggal_waktu_saat_ini = date($format_tanggal_waktu);

    // Menampilkan waktu dan tanggal saat ini
    return $tanggal_waktu_saat_ini;
}

// Menambahkan shortcode dengan nama "current_date_time_custom_format"
add_shortcode('format-tanggal', 'func_current_date_time_custom_format');


// SHORTCODE TOTAL JAM
function total_jam_shortcode() {
    ob_start(); // Mulai output buffering

    // Mendapatkan ID post saat ini
    global $post;

    // Mendapatkan meta values 'jam_masuk' dan 'jam_pulang' dari custom post type
    $jam_masuk = get_post_meta($post->ID, 'jam_masuk', true);
    $jam_pulang = get_post_meta($post->ID, 'jam_pulang', true);

    // Validasi jika meta values tersedia
    if ($jam_masuk && $jam_pulang) {
        // Menghitung selisih waktu
        $selisih_waktu = strtotime($jam_pulang) - strtotime($jam_masuk);

        // Mengonversi selisih waktu menjadi format jam:menit
        $total_jam = sprintf('%02d:%02d', ($selisih_waktu / 3600), ($selisih_waktu % 3600 / 60));

        // Menampilkan total jam
        echo 'Total Jam: ' . $total_jam;
    } 
    return ob_get_clean(); // Mengembalikan dan menghentikan output buffering
}

// Mendaftarkan shortcode dengan nama [total_jam]
add_shortcode('total_jam', 'total_jam_shortcode');
