<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class comman_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function userLogin($array) {
        $query = $this->db->get_where('user', $array);
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function check_user_id($table, $id, $value) {
        $this->db->where('md5(' . $id . ')', $value);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function check_user_by_id($table, $id, $value) {
        $this->db->where('md5(' . $id . ')', $value);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function add($table, $array) {
        $query = $this->db->insert($table, $array);
        //echo $this->db->last_query();die;
        //return $query->row_array();
        return $this->db->insert_id();
    }

    function record_count($table) {
        return $this->db->count_all($table);
    }

    function get_total_row($table, $where) {
        $query = $this->db->get_where($table, $where);
        return $query->num_rows();
        //return $this->db->count_all($table);
    }

    function get_data_by_pagination($table, $field, $value, $limit, $start) {
        $this->db->order_by($field, $value);
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);
        /* if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
          $data[] = $row;
          }
          return $data;
          } */
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_username($data) {
        $query = $this->db->get_where('user', $data);
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function get_average_by_id($table, $data, $field_name) {
        $query = $this->db->select_avg($field_name)->get_where($table, $data);
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function get_sum_by_id($table, $data, $field_name) {
        $query = $this->db->select_sum($field_name)->get_where($table, $data);
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function get_awards_remarks($code) {
        $this->db->select('title');
        $this->db->where('code', $code);
        $result = $this->db->get('serial_code');
        return $result->result_array();
    }

    function get_top_ranking($table, $field1, $field2, $new_name, $order) {
        $this->db->select($field1);
        $this->db->select_sum($field2, $new_name);
        $this->db->group_by($field1);
        $this->db->order_by($new_name, $order);
        $query = $this->db->get($table, 10);
        //	echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_top_ranking1($table, $field1, $field2, $new_name, $order) {
        $this->db->select($field1);
        $this->db->select_sum($field2, $new_name);
        $this->db->group_by($field1);
        $this->db->order_by($new_name, $order);
        $query = $this->db->get($table);
        //	echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_top_ranking2($table, $field1, $field2, $new_name, $order, $limit, $start) {
        $this->db->select($field1);
        $this->db->select_sum($field2, $new_name);
        $this->db->group_by($field1);
        $this->db->order_by($new_name, $order);
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);
        //	echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_all_top_ranking($table, $field1, $field2, $new_name2, $field3, $new_name3, $order) {
        $this->db->select($field1);
        $this->db->select_sum($field2, $new_name2);
        $this->db->select_sum($field3, $new_name3);
        $this->db->group_by($field1);
        $this->db->order_by($new_name2, $order);
        $this->db->order_by($new_name3, $order);
        $query = $this->db->get($table);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function query_result($query) {
        $query = $this->db->query($query);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_data_by_where_in($table, $condition, $where, $id, $value) {
        if ($where == 'not') {
            $this->db->where_not_in($id, $value);
        }
        $query = $this->db->get_where($table, $condition);
        return $query->result_array();
    }

    function get_all_data_by_id_with_order($table_name, $condition, $field_name, $order_by) {
        $query = $this->db->order_by($field_name, $order_by)->get_where($table_name, $condition);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_all_data_by_id_with_order1($table_name, $condition, $field_name1, $order_by1, $field_name2, $order_by2) {
        $query = $this->db->order_by($field_name1, $order_by1)->order_by($field_name2, $order_by2)->get_where($table_name, $condition);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function update_user_detail($siteData, $user_id) {
        $this->db->where('id', $user_id);
        $this->db->update('user', $siteData);
        //echo $this->db->last_query();die;
    }

    function all_data($table_Name) {

        $query = $this->db->get($table_Name);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function all_data_by_id($table_Name, $where) {

        $query = $this->db->get_where($table_Name, $where);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function all_data_by_condition($table_Name, $where, $order, $value) {
        $query = $this->db->or_where($where);
        $this->db->order_by($order, $value);
        $query = $this->db->get($table_Name);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function all_data_by_condition1($table_Name, $where1, $where2, $order, $value) {
        $this->db->where($where2);
        $query = $this->db->or_where($where1);
        $this->db->order_by($order, $value);
        $query = $this->db->get($table_Name);
        echo $this->db->last_query();
        die;
        return $query->result_array();
    }

    function all_data_by_condition2($table_Name, $where, $order, $value) {
        $query = $this->db->where($where);
        $this->db->order_by($order, $value);
        $query = $this->db->get($table_Name);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function delete_by_id($table, $where) {
        $this->db->delete($table, $where);
        return TRUE;
    }

    /*     * * added by razib from 4axiz start  ** */

    function deleteAllById($table, $array, $field = 'id') {
        $this->db->where_in($field, $array);
        $this->db->delete($table);
        return TRUE;
    }

    function getAllById($table, $array, $fields = null, $where_fields = 'id') {
        if ($fields) {
            $table_field = '';
            foreach ($fields as $field) {
                $table_field .= $field . ', ';
            }
            $this->db->select($table_field);
        }
        $this->db->where_in($where_fields, $array);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    /*     * * added by razib from 4axiz end  ** */

    function delete_winner_id($table, $where) {
        $this->db->delete($table, $where);
        return TRUE;
    }

    function last_row($table_Name, $where) {

        $query = $this->db->get_where($table_Name, $where);
        //echo $this->db->last_query();die;
        $last = $query->last_row('array');
        // retrieve last inserted id from table
        return $last;
    }

    function count_row_by_id($table_Name, $where) {

        $query = $this->db->get_where($table_Name, $where);
        //echo $this->db->last_query();die;
        return $query->num_rows();
        ;
    }

    function update_by_id($table_Name, $updatequery, $id) {
        $this->db->where('id', $id);
        $this->db->update($table_Name, $updatequery);
        return $this->db->affected_rows();
    }

    function update_data_by_id($table_Name, $updatequery, $field_name, $value) {
        $this->db->where($field_name, $value);
        $this->db->update($table_Name, $updatequery);
        return $this->db->affected_rows();
    }

    function update_data_by_condition($table_Name, $updatequery, $array) {
        $this->db->where($array);
        $this->db->update($table_Name, $updatequery);
        //	echo $this->db->last_query();die;
    }

    function get_data_by_id($tablename, $condition) {
        $query = $this->db->get_where($tablename, $condition);
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function get_all_data_by_id($table_name, $condition) {
        $query = $this->db->get_where($table_name, $condition);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function country_code_to_country($code) {
        $country = '';
        if ($code == 'AF')
            $country = 'Afghanistan';
        if ($code == 'AX')
            $country = 'Aland Islands';
        if ($code == 'AL')
            $country = 'Albania';
        if ($code == 'DZ')
            $country = 'Algeria';
        if ($code == 'AS')
            $country = 'American Samoa';
        if ($code == 'AD')
            $country = 'Andorra';
        if ($code == 'AO')
            $country = 'Angola';
        if ($code == 'AI')
            $country = 'Anguilla';
        if ($code == 'AQ')
            $country = 'Antarctica';
        if ($code == 'AG')
            $country = 'Antigua and Barbuda';
        if ($code == 'AR')
            $country = 'Argentina';
        if ($code == 'AM')
            $country = 'Armenia';
        if ($code == 'AW')
            $country = 'Aruba';
        if ($code == 'AU')
            $country = 'Australia';
        if ($code == 'AT')
            $country = 'Austria';
        if ($code == 'AZ')
            $country = 'Azerbaijan';
        if ($code == 'BS')
            $country = 'Bahamas the';
        if ($code == 'BH')
            $country = 'Bahrain';
        if ($code == 'BD')
            $country = 'Bangladesh';
        if ($code == 'BB')
            $country = 'Barbados';
        if ($code == 'BY')
            $country = 'Belarus';
        if ($code == 'BE')
            $country = 'Belgium';
        if ($code == 'BZ')
            $country = 'Belize';
        if ($code == 'BJ')
            $country = 'Benin';
        if ($code == 'BM')
            $country = 'Bermuda';
        if ($code == 'BT')
            $country = 'Bhutan';
        if ($code == 'BO')
            $country = 'Bolivia';
        if ($code == 'BA')
            $country = 'Bosnia and Herzegovina';
        if ($code == 'BW')
            $country = 'Botswana';
        if ($code == 'BV')
            $country = 'Bouvet Island (Bouvetoya)';
        if ($code == 'BR')
            $country = 'Brazil';
        if ($code == 'IO')
            $country = 'British Indian Ocean Territory (Chagos Archipelago)';
        if ($code == 'VG')
            $country = 'British Virgin Islands';
        if ($code == 'BN')
            $country = 'Brunei Darussalam';
        if ($code == 'BG')
            $country = 'Bulgaria';
        if ($code == 'BF')
            $country = 'Burkina Faso';
        if ($code == 'BI')
            $country = 'Burundi';
        if ($code == 'KH')
            $country = 'Cambodia';
        if ($code == 'CM')
            $country = 'Cameroon';
        if ($code == 'CA')
            $country = 'Canada';
        if ($code == 'CV')
            $country = 'Cape Verde';
        if ($code == 'KY')
            $country = 'Cayman Islands';
        if ($code == 'CF')
            $country = 'Central African Republic';
        if ($code == 'TD')
            $country = 'Chad';
        if ($code == 'CL')
            $country = 'Chile';
        if ($code == 'CN')
            $country = 'China';
        if ($code == 'CX')
            $country = 'Christmas Island';
        if ($code == 'CC')
            $country = 'Cocos (Keeling) Islands';
        if ($code == 'CO')
            $country = 'Colombia';
        if ($code == 'KM')
            $country = 'Comoros the';
        if ($code == 'CD')
            $country = 'Congo';
        if ($code == 'CG')
            $country = 'Congo the';
        if ($code == 'CK')
            $country = 'Cook Islands';
        if ($code == 'CR')
            $country = 'Costa Rica';
        if ($code == 'CI')
            $country = 'Cote d\'Ivoire';
        if ($code == 'HR')
            $country = 'Croatia';
        if ($code == 'CU')
            $country = 'Cuba';
        if ($code == 'CY')
            $country = 'Cyprus';
        if ($code == 'CZ')
            $country = 'Czech Republic';
        if ($code == 'DK')
            $country = 'Denmark';
        if ($code == 'DJ')
            $country = 'Djibouti';
        if ($code == 'DM')
            $country = 'Dominica';
        if ($code == 'DO')
            $country = 'Dominican Republic';
        if ($code == 'EC')
            $country = 'Ecuador';
        if ($code == 'EG')
            $country = 'Egypt';
        if ($code == 'SV')
            $country = 'El Salvador';
        if ($code == 'GQ')
            $country = 'Equatorial Guinea';
        if ($code == 'ER')
            $country = 'Eritrea';
        if ($code == 'EE')
            $country = 'Estonia';
        if ($code == 'ET')
            $country = 'Ethiopia';
        if ($code == 'FO')
            $country = 'Faroe Islands';
        if ($code == 'FK')
            $country = 'Falkland Islands (Malvinas)';
        if ($code == 'FJ')
            $country = 'Fiji the Fiji Islands';
        if ($code == 'FI')
            $country = 'Finland';
        if ($code == 'FR')
            $country = 'France, French Republic';
        if ($code == 'GF')
            $country = 'French Guiana';
        if ($code == 'PF')
            $country = 'French Polynesia';
        if ($code == 'TF')
            $country = 'French Southern Territories';
        if ($code == 'GA')
            $country = 'Gabon';
        if ($code == 'GM')
            $country = 'Gambia the';
        if ($code == 'GE')
            $country = 'Georgia';
        if ($code == 'DE')
            $country = 'Germany';
        if ($code == 'GH')
            $country = 'Ghana';
        if ($code == 'GI')
            $country = 'Gibraltar';
        if ($code == 'GR')
            $country = 'Greece';
        if ($code == 'GL')
            $country = 'Greenland';
        if ($code == 'GD')
            $country = 'Grenada';
        if ($code == 'GP')
            $country = 'Guadeloupe';
        if ($code == 'GU')
            $country = 'Guam';
        if ($code == 'GT')
            $country = 'Guatemala';
        if ($code == 'GG')
            $country = 'Guernsey';
        if ($code == 'GN')
            $country = 'Guinea';
        if ($code == 'GW')
            $country = 'Guinea-Bissau';
        if ($code == 'GY')
            $country = 'Guyana';
        if ($code == 'HT')
            $country = 'Haiti';
        if ($code == 'HM')
            $country = 'Heard Island and McDonald Islands';
        if ($code == 'VA')
            $country = 'Holy See (Vatican City State)';
        if ($code == 'HN')
            $country = 'Honduras';
        if ($code == 'HK')
            $country = 'Hong Kong';
        if ($code == 'HU')
            $country = 'Hungary';
        if ($code == 'IS')
            $country = 'Iceland';
        if ($code == 'IN')
            $country = 'India';
        if ($code == 'ID')
            $country = 'Indonesia';
        if ($code == 'IR')
            $country = 'Iran';
        if ($code == 'IQ')
            $country = 'Iraq';
        if ($code == 'IE')
            $country = 'Ireland';
        if ($code == 'IM')
            $country = 'Isle of Man';
        if ($code == 'IL')
            $country = 'Israel';
        if ($code == 'IT')
            $country = 'Italy';
        if ($code == 'JM')
            $country = 'Jamaica';
        if ($code == 'JP')
            $country = 'Japan';
        if ($code == 'JE')
            $country = 'Jersey';
        if ($code == 'JO')
            $country = 'Jordan';
        if ($code == 'KZ')
            $country = 'Kazakhstan';
        if ($code == 'KE')
            $country = 'Kenya';
        if ($code == 'KI')
            $country = 'Kiribati';
        if ($code == 'KP')
            $country = 'Korea';
        if ($code == 'KR')
            $country = 'Korea';
        if ($code == 'KW')
            $country = 'Kuwait';
        if ($code == 'KG')
            $country = 'Kyrgyz Republic';
        if ($code == 'LA')
            $country = 'Lao';
        if ($code == 'LV')
            $country = 'Latvia';
        if ($code == 'LB')
            $country = 'Lebanon';
        if ($code == 'LS')
            $country = 'Lesotho';
        if ($code == 'LR')
            $country = 'Liberia';
        if ($code == 'LY')
            $country = 'Libyan Arab Jamahiriya';
        if ($code == 'LI')
            $country = 'Liechtenstein';
        if ($code == 'LT')
            $country = 'Lithuania';
        if ($code == 'LU')
            $country = 'Luxembourg';
        if ($code == 'MO')
            $country = 'Macao';
        if ($code == 'MK')
            $country = 'Macedonia';
        if ($code == 'MG')
            $country = 'Madagascar';
        if ($code == 'MW')
            $country = 'Malawi';
        if ($code == 'MY')
            $country = 'Malaysia';
        if ($code == 'MV')
            $country = 'Maldives';
        if ($code == 'ML')
            $country = 'Mali';
        if ($code == 'MT')
            $country = 'Malta';
        if ($code == 'MH')
            $country = 'Marshall Islands';
        if ($code == 'MQ')
            $country = 'Martinique';
        if ($code == 'MR')
            $country = 'Mauritania';
        if ($code == 'MU')
            $country = 'Mauritius';
        if ($code == 'YT')
            $country = 'Mayotte';
        if ($code == 'MX')
            $country = 'Mexico';
        if ($code == 'FM')
            $country = 'Micronesia';
        if ($code == 'MD')
            $country = 'Moldova';
        if ($code == 'MC')
            $country = 'Monaco';
        if ($code == 'MN')
            $country = 'Mongolia';
        if ($code == 'ME')
            $country = 'Montenegro';
        if ($code == 'MS')
            $country = 'Montserrat';
        if ($code == 'MA')
            $country = 'Morocco';
        if ($code == 'MZ')
            $country = 'Mozambique';
        if ($code == 'MM')
            $country = 'Myanmar';
        if ($code == 'NA')
            $country = 'Namibia';
        if ($code == 'NR')
            $country = 'Nauru';
        if ($code == 'NP')
            $country = 'Nepal';
        if ($code == 'AN')
            $country = 'Netherlands Antilles';
        if ($code == 'NL')
            $country = 'Netherlands the';
        if ($code == 'NC')
            $country = 'New Caledonia';
        if ($code == 'NZ')
            $country = 'New Zealand';
        if ($code == 'NI')
            $country = 'Nicaragua';
        if ($code == 'NE')
            $country = 'Niger';
        if ($code == 'NG')
            $country = 'Nigeria';
        if ($code == 'NU')
            $country = 'Niue';
        if ($code == 'NF')
            $country = 'Norfolk Island';
        if ($code == 'MP')
            $country = 'Northern Mariana Islands';
        if ($code == 'NO')
            $country = 'Norway';
        if ($code == 'OM')
            $country = 'Oman';
        if ($code == 'PK')
            $country = 'Pakistan';
        if ($code == 'PW')
            $country = 'Palau';
        if ($code == 'PS')
            $country = 'Palestinian Territory';
        if ($code == 'PA')
            $country = 'Panama';
        if ($code == 'PG')
            $country = 'Papua New Guinea';
        if ($code == 'PY')
            $country = 'Paraguay';
        if ($code == 'PE')
            $country = 'Peru';
        if ($code == 'PH')
            $country = 'Philippines';
        if ($code == 'PN')
            $country = 'Pitcairn Islands';
        if ($code == 'PL')
            $country = 'Poland';
        if ($code == 'PT')
            $country = 'Portugal, Portuguese Republic';
        if ($code == 'PR')
            $country = 'Puerto Rico';
        if ($code == 'QA')
            $country = 'Qatar';
        if ($code == 'RE')
            $country = 'Reunion';
        if ($code == 'RO')
            $country = 'Romania';
        if ($code == 'RU')
            $country = 'Russian Federation';
        if ($code == 'RW')
            $country = 'Rwanda';
        if ($code == 'BL')
            $country = 'Saint Barthelemy';
        if ($code == 'SH')
            $country = 'Saint Helena';
        if ($code == 'KN')
            $country = 'Saint Kitts and Nevis';
        if ($code == 'LC')
            $country = 'Saint Lucia';
        if ($code == 'MF')
            $country = 'Saint Martin';
        if ($code == 'PM')
            $country = 'Saint Pierre and Miquelon';
        if ($code == 'VC')
            $country = 'Saint Vincent and the Grenadines';
        if ($code == 'WS')
            $country = 'Samoa';
        if ($code == 'SM')
            $country = 'San Marino';
        if ($code == 'ST')
            $country = 'Sao Tome and Principe';
        if ($code == 'SA')
            $country = 'Saudi Arabia';
        if ($code == 'SN')
            $country = 'Senegal';
        if ($code == 'RS')
            $country = 'Serbia';
        if ($code == 'SC')
            $country = 'Seychelles';
        if ($code == 'SL')
            $country = 'Sierra Leone';
        if ($code == 'SG')
            $country = 'Singapore';
        if ($code == 'SK')
            $country = 'Slovakia (Slovak Republic)';
        if ($code == 'SI')
            $country = 'Slovenia';
        if ($code == 'SB')
            $country = 'Solomon Islands';
        if ($code == 'SO')
            $country = 'Somalia, Somali Republic';
        if ($code == 'ZA')
            $country = 'South Africa';
        if ($code == 'GS')
            $country = 'South Georgia and the South Sandwich Islands';
        if ($code == 'ES')
            $country = 'Spain';
        if ($code == 'LK')
            $country = 'Sri Lanka';
        if ($code == 'SD')
            $country = 'Sudan';
        if ($code == 'SR')
            $country = 'Suriname';
        if ($code == 'SJ')
            $country = 'Svalbard & Jan Mayen Islands';
        if ($code == 'SZ')
            $country = 'Swaziland';
        if ($code == 'SE')
            $country = 'Sweden';
        if ($code == 'CH')
            $country = 'Switzerland, Swiss Confederation';
        if ($code == 'SY')
            $country = 'Syrian Arab Republic';
        if ($code == 'TW')
            $country = 'Taiwan';
        if ($code == 'TJ')
            $country = 'Tajikistan';
        if ($code == 'TZ')
            $country = 'Tanzania';
        if ($code == 'TH')
            $country = 'Thailand';
        if ($code == 'TL')
            $country = 'Timor-Leste';
        if ($code == 'TG')
            $country = 'Togo';
        if ($code == 'TK')
            $country = 'Tokelau';
        if ($code == 'TO')
            $country = 'Tonga';
        if ($code == 'TT')
            $country = 'Trinidad and Tobago';
        if ($code == 'TN')
            $country = 'Tunisia';
        if ($code == 'TR')
            $country = 'Turkey';
        if ($code == 'TM')
            $country = 'Turkmenistan';
        if ($code == 'TC')
            $country = 'Turks and Caicos Islands';
        if ($code == 'TV')
            $country = 'Tuvalu';
        if ($code == 'UG')
            $country = 'Uganda';
        if ($code == 'UA')
            $country = 'Ukraine';
        if ($code == 'AE')
            $country = 'United Arab Emirates';
        if ($code == 'GB')
            $country = 'United Kingdom';
        if ($code == 'US')
            $country = 'United States of America';
        if ($code == 'UM')
            $country = 'United States Minor Outlying Islands';
        if ($code == 'VI')
            $country = 'United States Virgin Islands';
        if ($code == 'UY')
            $country = 'Uruguay, Eastern Republic of';
        if ($code == 'UZ')
            $country = 'Uzbekistan';
        if ($code == 'VU')
            $country = 'Vanuatu';
        if ($code == 'VE')
            $country = 'Venezuela';
        if ($code == 'VN')
            $country = 'Vietnam';
        if ($code == 'WF')
            $country = 'Wallis and Futuna';
        if ($code == 'EH')
            $country = 'Western Sahara';
        if ($code == 'YE')
            $country = 'Yemen';
        if ($code == 'ZM')
            $country = 'Zambia';
        if ($code == 'ZW')
            $country = 'Zimbabwe';
        if ($country == '')
            $country = $code;
        return $country;
    }

    function search_serial_data($table) {
        $query = $this->db->get_where($table);
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_list_by_group($table, $field) {
        $this->db->group_by($field);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function delete_blocked_id($table, $array) {
        $this->db->where($array);
        $query = $this->db->get($table);
        $result = $query->result_array();
        $email = $result[0]['email'];
        $this->db->delete($table, array('email' => $email));
        return true;
    }

    function delete_blocked_all($table) {
        $this->db->empty_table($table);
    }

    function get_winner_by_id($table, $array) {
        $this->db->where($array);
        $query = $this->db->get($table);
        $result = $query->result_array();
        return $result[0];
    }

    function get_breadcrumbcategorydetailsbyid($vehicle_category_id) {
        $this->db->where('id', $vehicle_category_id);
        $query = $this->db->get('tbl_vehicle_categories');
        $result = $query->row();
        $breadcrumb = '';
        if ($result->vehicle_category_icon != '')
            $breadcrumb.= '&nbsp;&nbsp;<img alt="Kondar Global" src="assets/uploads/vehicle_categories/' . $result->vehicle_category_icon . '" width="35">';
        $breadcrumb.= '&nbsp;&nbsp;' . $result->category_name . '';
        return $breadcrumb;
    }

    function get_breadcrumbproducttypedetailsbyid($vehicle_type_id) {
        $this->db->where('id', $vehicle_type_id);
        $query = $this->db->get('tbl_product_types');
        $result = $query->row();
        $breadcrumb = '&nbsp;&nbsp;' . $result->product_type_name . '';
        return $breadcrumb;
    }

    function get_breadcrumbmakerdetailsbyid($product_maker_id) {
        $this->db->where('id', $product_maker_id);
        $query = $this->db->get('tbl_makers');
        $result = $query->row();
        $breadcrumb = '&nbsp;&nbsp;' . $result->maker_name . '';
        return $breadcrumb;
    }

    function get_vehicle_categories($product_type, $offset = 0) {
        $querysql = "SELECT tbl_vehicle_categories.* FROM tbl_product_types JOIN tbl_vehicle_categories ON tbl_product_types.vehicle_category_id = tbl_vehicle_categories.id WHERE tbl_product_types.product_type_name = '" . $product_type . "'";
        //echo $querysql;
        //if($offset){
        $querysql.= " limit " . $offset . "," . $this->config->item('pagination_limit');
        //}
        $query = $this->db->query($querysql);
        return $query->result();
    }

    function count_vehicle_categories($product_type) {
        $querysql = "SELECT tbl_vehicle_categories.* FROM tbl_product_types JOIN tbl_vehicle_categories ON tbl_product_types.vehicle_category_id = tbl_vehicle_categories.id WHERE tbl_product_types.product_type_name = '" . $product_type . "'";

        $query = $this->db->query($querysql);
        return $query->num_rows();
    }

    function get_vehicle_categories_by_id($product_id, $offset = 0) {
        $querysql = "SELECT tbl_vehicle_categories.* FROM tbl_product_types JOIN tbl_vehicle_categories ON tbl_product_types.vehicle_category_id = tbl_vehicle_categories.id WHERE 1=1 ";
        if (!empty($product_id)) {
            $querysql_1 = "";
            $i = 1;
            foreach ($product_id as $id) {
                $product_type = str_replace('_', ' ', $id);
                if ($id != '') {
                    if ($i > 1)
                        $querysql_1.= " OR tbl_product_types.product_type_name like '%" . $product_type . "%' ";
                    else
                        $querysql_1.= " AND ( tbl_product_types.product_type_name like '%" . $product_type . "' ";

                    $i++;
                }
            }
            if ($querysql_1 != '')
                $querysql_1.= " ) ";
            $querysql.= $querysql_1;
        }
        //echo $querysql;
        $querysql.= " GROUP BY tbl_vehicle_categories.id ";
        $querysql.= " limit " . $offset . "," . $this->config->item('pagination_limit');

        $query = $this->db->query($querysql);
        return $query->result();
    }

    function count_vehicle_categories_by_id($product_id) {
        $querysql = "SELECT tbl_vehicle_categories.* FROM tbl_product_types JOIN tbl_vehicle_categories ON tbl_product_types.vehicle_category_id = tbl_vehicle_categories.id WHERE 1=1 ";
        if (!empty($product_id)) {
            $querysql_1 = "";
            $i = 1;
            foreach ($product_id as $id) {
                $product_type = str_replace('_', ' ', $id);
                if ($id != '') {
                    if ($i > 1)
                        $querysql_1.= " OR tbl_product_types.product_type_name like '%" . $product_type . "%' ";
                    else
                        $querysql_1.= " AND ( tbl_product_types.product_type_name like '%" . $product_type . "' ";

                    $i++;
                }
            }
            if ($querysql_1 != '')
                $querysql_1.= " ) ";
            $querysql.= $querysql_1;
        }
        //echo $querysql;
        $querysql.= " GROUP BY tbl_vehicle_categories.id ";
        $query = $this->db->query($querysql);
        return $query->num_rows();
    }

    function get_vehicle_type_details_by_name($product_type) {
        $querysql = "SELECT * FROM tbl_product_types where product_type_name = '" . $product_type . "'";
        //echo $querysql;
        $query = $this->db->query($querysql);
        return $query->result();
    }

    function get_prodouct_type($product_type, $vehicle_category_ids) {
        $product_type_array = array();
        foreach ($vehicle_category_ids as $vehicle_category_id) {
            $querysql = "SELECT tbl_product_types.* FROM tbl_product_types WHERE tbl_product_types.product_type_name = '" . $product_type . "' and tbl_product_types.vehicle_category_id = " . $vehicle_category_id;
            $query = $this->db->query($querysql);
            $details = $query->row();
            $product_type_array[] = $details->id;
        }
        return $product_type_array;
    }

    function get_product_type_for_menu1() {
        $querysql = "SELECT tbl_product_types.* FROM tbl_product_types group by tbl_product_types.product_type_name";
        $query = $this->db->query($querysql);
        return $query->result();
    }

    function get_product_type_for_menu($offset = 0) {
        $this->db->group_by('tbl_product_types.product_type_name');
        $query = $this->db->get('tbl_product_types', $this->config->item('pagination_limit'), $offset);
        //echo $this->db->last_query();
        return $query->result();
    }

    function num_product_type_for_menu() {
        $this->db->group_by('product_type_name');
        $query = $this->db->get('tbl_product_types');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function get_tabledata_by_id($table, $id, $where) {
        $this->db->where('id', $id);
        $this->db->where($where, 1);
        $result = $this->db->get($table);
        return $result->result_array();
    }

    function get_tabledata_block_id($table, $id) {
        $this->db->where('int_id', $id);
        $result = $this->db->get($table);
        return $result->result_array();
    }

    function delete_block_email_list_by_id($email) {
        $this->db->where('str_email', $email);
        $this->db->delete('block_email_list');
        return $this->db->affected_rows();
    }

    function delete_block_email_by_table($table, $where1, $where2) {
        if ($table == 'tbl_dist_app_support') {
            $this->db->where('str_email', $where2);
        } else if ($table == 'cart_block_users') {
            $this->db->where('email', $where2);
        } else {
            $this->db->where('email', $where2);
            $this->db->where($where1, 1);
        }
        $this->db->delete($table);
    }

    function get_code_remarks($code) {
        $this->db->select('title');
        $this->db->where('code', $code);
        $result = $this->db->get('serial_code');
        return $result->result_array();
    }

    function get_timer($table, $select) {
        $this->db->select($select);
        $result = $this->db->get($table);
        return $result->result_array();
    }

    function get_isactive_checkbox($table, $id, $value) {
        $this->db->where($id, $value);
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        $result = $query->row_array();
        //echo "<pre>"; print_r($result); 

        if (!empty($result)) {
            if ($result['is_product_selectall'] == 'Y') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_vehicle_categoriesjeet($product_type, $offset = NULL) {

        $this->db->select('*');
        $this->db->join('tbl_product_types', 'tbl_product_types.vehicle_category_id = tbl_vehicle_categories.id');
        $this->db->where('tbl_product_types.product_type_name', $product_type);
        $query = $this->db->get('tbl_vehicle_categories', $this->config->item('pagination_limit'), $offset);
        echo $this->db->last_query();
        //return $query->result();
    }

    function get_vehicle_type_for_menu($offset = 0) {
        $query = $this->db->get('tbl_vehicle_categories', $this->config->item('pagination_limit'), $offset);
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function num_vehicle_type_for_menu() {
        $query = $this->db->count_all_results('tbl_vehicle_categories');
        return $query;
    }

   public function get_vichle_type_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_product_types');
        $result = $query->row();
        return  $result->product_type_name;

    }

    public function getVicleDetailsById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_product_types');
        return $query->row();
    }

}

/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>
