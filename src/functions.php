<?php

namespace andrewk74\adump;

class PrintData
{
    static function pretty_print($in, $opened = true)
    {
        if ($opened)
            $opened = ' open';
        if (is_object($in) or is_array($in)) {
            echo '<div>';
            echo '<details' . $opened . '>';
            echo '<summary>';
            echo (is_object($in)) ? 'Object {' . count((array)$in) . '}' : 'Array [' . count($in) . ']';
            echo '</summary>';
            self::pretty_print_rec($in, $opened);
            echo '</details>';
            echo '</div>';
        }
    }

    static function pretty_print_rec($in, $opened, $margin = 10)
    {


        if (!is_object($in) && !is_array($in))
            return;
        // var_dump($in);
        if (is_object($in)) {
            echo 'Class ' . get_class($in);
        }
        foreach ($in as $key => $value) {
            if (is_object($value) or is_array($value)) {
                echo '<details style="margin-left:' . $margin . 'px" ' . $opened . '>';
                echo '<summary>';
                // echo (is_object($value)) ? $key . ' {' . count((array)$value) . '}' : $key . ' [' . count($value) . ']';
                if (is_object($value)) {
                    echo $key . ' {' . count((array)$value) . '}';
                } else {
                    echo $key . ' [' . count($value) . ']';
                }

                echo '</summary>';
                self::pretty_print_rec($value, $opened, $margin + 10);
                echo '</details>';
            } else {
                switch (gettype($value)) {
                    case 'string':
                    default:
                        $bgc = 'red';
                        break;
                    case 'integer':
                        $bgc = 'green';
                        break;
                }
                echo '<div style="margin-left:' . $margin . 'px">' . $key . ' : <span style="color:' . $bgc . '">' . $value . '</span> 
(' . gettype($value) . ')</div>';
            }
        }
    }

    static function adump($var, $die = false)

    {
        if (is_array($var)) {
            ?><p>Значение массива</p><? self::pretty_print($var);
        } else { ?><p>Значение переменной</p><? var_dump($var);
        }

        if ($die) {
            die;
        }

    }
}

?>