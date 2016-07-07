<?php

namespace Campus\Tool;

class StringUtils
{
    /**
     * @param string $objectType
     * @return array|string
     */
    public static function getIndexNameFromObjectType($objectType)
    {
        return self::camelize($objectType);
    }

    /**
     * @param string $fullyQualifiedName
     * @return string
     */
    public static function getIndexNameFromNodeClassFullyQualifiedName($fullyQualifiedName)
    {
        $fullyQualifiedName = explode('\\', $fullyQualifiedName);
        $indexName = end($fullyQualifiedName);

        return $indexName;
    }

    /**
     * @param string $objectType
     * @return string
     */
    public static function objectTypeToEventClassFullyQualifiedName($objectType)
    {
        $className = self::camelize($objectType);
        $className = 'Campus\\Event\\' . $className;

        return $className;
    }

    /**
     * @param string $objectType
     * @return string
     */
    public static function getLabelNameFromObjectType($objectType)
    {
        $labelName = explode('-', $objectType);
        $labelName = array_map('strtoupper', $labelName);
        $labelName = implode('_', $labelName );

        return $labelName;
    }

    /**
     * @param string $fullyQualifiedName
     * @return string
     */
    public static function getObjectTypeFromNodeClassFullyQualifiedName($fullyQualifiedName)
    {
        $objectType = explode('\\', $fullyQualifiedName);
        $objectType = end($objectType);
        $objectType = preg_replace('/([a-z])([A-Z])/', '$1-$2', $objectType);
        $objectType = strtolower($objectType);

        return $objectType;
    }

    /**
     * @param string $objectType
     * @return string
     */
    public static function getNodeClassFullyQualifiedNameFromObjectType($objectType)
    {
        $fullyQualifiedName = self::camelize($objectType);
        $fullyQualifiedName = 'Campus\\Lib\\Graph\\Node\\' . $fullyQualifiedName;

        return $fullyQualifiedName;
    }

    /**
     * @param string $objectType
     * @return string
     */
    public static function getActivityStreamsObjectClassFullyQualifiedNameFromObjectType($objectType)
    {
        $fullyQualifiedName = self::camelize($objectType);
        $fullyQualifiedName = '\\Campus\\ActivityStreams\\Object\\' . $fullyQualifiedName;

        return $fullyQualifiedName;
    }

    /**
     * @param $verb
     * @return string
     */
    public static function getRelationshipClassFullyQualifiedNameFromVerb($verb)
    {
        $fullyQualifiedName = strtolower($verb);
        $fullyQualifiedName = self::camelize($fullyQualifiedName);
        $fullyQualifiedName = 'Campus\\Lib\\Graph\\Relationship\\' . $fullyQualifiedName;

        return $fullyQualifiedName;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function normalizeString($string)
    {
        setlocale(LC_ALL, 'pt_PT.UTF8');
        $normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $normalized = strtolower($normalized);
        $normalized = trim($normalized);

        return $normalized;
    }

    /**
     * @param $string
     * @param $desiredLength
     * @param string $terminator
     * @return string
     */
    public static function truncate($string, $desiredLength, $terminator = '…')
    {
        $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
        $partsCount = count($parts);

        $length = 0;
        $lastPart = 0;
        for (; $lastPart < $partsCount; ++$lastPart) {
            $length += strlen($parts[$lastPart]);
            if ($length > $desiredLength) {
                break;
            }
        }

        return implode(array_slice($parts, 0, $lastPart)) . $terminator;
    }

    /**
     * Truncates text.
     *
     * Cuts a string to the length of $length and replaces the last characters
     * with the ending if the text is longer than length.
     *
     * @param string  $text String to truncate.
     * @param integer $length Length of returned string, including ellipsis.
     * @param string  $ending Ending to be appended to the trimmed string.
     * @param boolean $exact If false, $text will not be cut mid-word
     * @param boolean $considerHtml If true, HTML tags would be handled correctly
     * @return string Trimmed string.
     */
    public static function truncateHtml( $text, $length = 100, $ending = '…', $exact = true, $considerHtml = false )
    {
        $total_length = strlen( $ending );
        $open_tags = array();
        $truncate = '';

        if ( $considerHtml ) {
            // if the plain text is shorter than the maximum length, return the whole text
            if ( strlen( preg_replace( '/<.*?>/', '', $text ) ) <= $length ) {
                return $text;
            }

            // splits all html-tags to scanable lines
            preg_match_all( '/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER );

            foreach ( $lines as $line_matchings ) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if ( !empty( $line_matchings[ 1 ] ) ) {
                    // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
                    if ( preg_match( '/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[ 1 ] ) ) {
                        // do nothing
                        // if tag is a closing tag (f.e. </b>)
                    } else if ( preg_match( '/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[ 1 ], $tag_matchings ) ) {
                        // delete tag from $open_tags list
                        $pos = array_search( $tag_matchings[ 1 ], $open_tags );
                        if ( $pos !== false ) {
                            unset( $open_tags[ $pos ] );
                        }
                        // if tag is an opening tag (f.e. <b>)
                    } else if ( preg_match( '/^<\s*([^\s>!]+).*?>$/s', $line_matchings[ 1 ], $tag_matchings ) ) {
                        // add tag to the beginning of $open_tags list
                        array_unshift( $open_tags, strtolower( $tag_matchings[ 1 ] ) );
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[ 1 ];
                }

                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen( preg_replace( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[ 2 ] ) );
                if ( $total_length + $content_length > $length ) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if ( preg_match_all( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[ 2 ], $entities, PREG_OFFSET_CAPTURE ) ) {
                        // calculate the real length of all entities in the legal range
                        foreach ( $entities[ 0 ] as $entity ) {
                            if ( $entity[ 1 ] + 1 - $entities_length <= $left ) {
                                $left--;
                                $entities_length += strlen( $entity[ 0 ] );
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr( $line_matchings[ 2 ], 0, $left + $entities_length );
                    // maximum length is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[ 2 ];
                    $total_length += $content_length;
                }

                // if the maximum length is reached, get off the loop
                if ( $total_length >= $length ) {
                    break;
                }
            }
        } else {
            if ( strlen( $text ) <= $length ) {
                return $text;
            } else {
                $truncate = substr( $text, 0, $length - strlen( $ending ) );
            }
        }

        // if the words shouldn't be cut in the middle...
        if ( !$exact ) {
            // ...search the last occurance of a space...
            $spacepos = strrpos( $truncate, ' ' );
            if ( isset( $spacepos ) ) {
                // ...and cut the text in this position
                $truncate = substr( $truncate, 0, $spacepos );
            }
        }

        // add the defined ending to the text
        $truncate .= $ending;

        if ( $considerHtml ) {
            // close all unclosed html-tags
            foreach ( $open_tags as $tag ) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;
    }

    public static function camelize($string)
    {
        $string = explode('-', $string);
        $string = array_map('ucwords', $string);
        $string = implode('', $string);

        return $string;
    }

    /**
     * Escaping for HTML blocks.
     *
     * @since 2.8.0
     *
     * @param string $text
     * @return string
     */
    public static function esc_html( $text ) {
        $safe_text = self::wp_check_invalid_utf8( $text );
        $safe_text = self::_wp_specialchars( $safe_text, ENT_QUOTES );
        /**
         * Filter a string cleaned and escaped for output in HTML.
         *
         * Text passed to esc_html() is stripped of invalid or special characters
         * before output.
         *
         * @since 2.8.0
         *
         * @param string $safe_text The text after it has been escaped.
         * @param string $text      The text prior to being escaped.
         */
        return self::apply_filters( 'esc_html', $safe_text, $text );
    }

    /**
     * Checks for invalid UTF8 in a string.
     *
     * @since 2.8.0
     *
     * @param string $string The text which is to be checked.
     * @param boolean $strip Optional. Whether to attempt to strip out invalid UTF8. Default is false.
     * @return string The checked text.
     */
    public static function wp_check_invalid_utf8( $string, $strip = false ) {
        $string = (string) $string;

        if ( 0 === strlen( $string ) ) {
            return '';
        }

        // Store the site charset as a static to avoid multiple calls to get_option()
        static $is_utf8;
        if ( !isset( $is_utf8 ) ) {
            $is_utf8 = in_array( 'utf8', array( 'utf8', 'utf-8', 'UTF8', 'UTF-8' ) );
        }
        if ( !$is_utf8 ) {
            return $string;
        }

        // Check for support for utf8 in the installed PCRE library once and store the result in a static
        static $utf8_pcre;
        if ( !isset( $utf8_pcre ) ) {
            $utf8_pcre = @preg_match( '/^./u', 'a' );
        }
        // We can't demand utf8 in the PCRE installation, so just return the string in those cases
        if ( !$utf8_pcre ) {
            return $string;
        }

        // preg_match fails when it encounters invalid UTF8 in $string
        if ( 1 === @preg_match( '/^./us', $string ) ) {
            return $string;
        }

        // Attempt to strip the bad chars if requested (not recommended)
        if ( $strip && function_exists( 'iconv' ) ) {
            return iconv( 'utf-8', 'utf-8', $string );
        }

        return '';
    }

    /**
     * Converts a number of special characters into their HTML entities.
     *
     * Specifically deals with: &, <, >, ", and '.
     *
     * $quote_style can be set to ENT_COMPAT to encode " to
     * &quot;, or ENT_QUOTES to do both. Default is ENT_NOQUOTES where no quotes are encoded.
     *
     * @since 1.2.2
     * @access private
     *
     * @param string $string The text which is to be encoded.
     * @param int $quote_style Optional. Converts double quotes if set to ENT_COMPAT, both single and double if set to ENT_QUOTES or none if set to ENT_NOQUOTES. Also compatible with old values; converting single quotes if set to 'single', double if set to 'double' or both if otherwise set. Default is ENT_NOQUOTES.
     * @param string $charset Optional. The character encoding of the string. Default is false.
     * @param boolean $double_encode Optional. Whether to encode existing html entities. Default is false.
     * @return string The encoded text with HTML entities.
     */
    public static function _wp_specialchars( $string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false ) {
        $string = (string) $string;

        if ( 0 === strlen( $string ) )
            return '';

        // Don't bother if there are no specialchars - saves some processing
        if ( ! preg_match( '/[&<>"\']/', $string ) )
            return $string;

        // Account for the previous behaviour of the function when the $quote_style is not an accepted value
        if ( empty( $quote_style ) )
            $quote_style = ENT_NOQUOTES;
        elseif ( ! in_array( $quote_style, array( 0, 2, 3, 'single', 'double' ), true ) )
            $quote_style = ENT_QUOTES;

//		// Store the site charset as a static to avoid multiple calls to wp_load_alloptions()
//		if ( ! $charset ) {
//			static $_charset;
//			if ( ! isset( $_charset ) ) {
//				$alloptions = wp_load_alloptions();
//				$_charset = isset( $alloptions['blog_charset'] ) ? $alloptions['blog_charset'] : '';
//			}
//			$charset = $_charset;
//		}

//		if ( in_array( $charset, array( 'utf8', 'utf-8', 'UTF8' ) ) )
        $charset = 'UTF-8';

        $_quote_style = $quote_style;

        if ( $quote_style === 'double' ) {
            $quote_style = ENT_COMPAT;
            $_quote_style = ENT_COMPAT;
        } elseif ( $quote_style === 'single' ) {
            $quote_style = ENT_NOQUOTES;
        }

        // Handle double encoding ourselves
        if ( $double_encode ) {
            $string = @htmlspecialchars( $string, $quote_style, $charset );
        } else {
            // Decode &amp; into &
            $string = self::wp_specialchars_decode( $string, $_quote_style );

            // Guarantee every &entity; is valid or re-encode the &
            $string = self::wp_kses_normalize_entities( $string );

            // Now re-encode everything except &entity;
            $string = preg_split( '/(&#?x?[0-9a-z]+;)/i', $string, -1, PREG_SPLIT_DELIM_CAPTURE );

            for ( $i = 0, $c = count( $string ); $i < $c; $i += 2 ) {
                $string[$i] = @htmlspecialchars( $string[$i], $quote_style, $charset );
            }
            $string = implode( '', $string );
        }

        // Backwards compatibility
        if ( 'single' === $_quote_style )
            $string = str_replace( "'", '&#039;', $string );

        return $string;
    }

    /**
     * Call the functions added to a filter hook.
     *
     * The callback functions attached to filter hook $tag are invoked by calling
     * this function. This function can be used to create a new filter hook by
     * simply calling this function with the name of the new hook specified using
     * the $tag parameter.
     *
     * The function allows for additional arguments to be added and passed to hooks.
     *
     *     // Our filter callback function
     *     function example_callback( $string, $arg1, $arg2 ) {
     *         // (maybe) modify $string
     *         return $string;
     *     }
     *     add_filter( 'example_filter', 'example_callback', 10, 3 );
     *
     *     /*
     *      * Apply the filters by calling the 'example_callback' function we
     *      * "hooked" to 'example_filter' using the add_filter() function above.
     *      * - 'example_filter' is the filter hook $tag
     *      * - 'filter me' is the value being filtered
     *      * - $arg1 and $arg2 are the additional arguments passed to the callback.
     *     $value = apply_filters( 'example_filter', 'filter me', $arg1, $arg2 );
     *
     * @since 0.71
     *
     * @global array $wp_filter         Stores all of the filters.
     * @global array $merged_filters    Merges the filter hooks using this function.
     * @global array $wp_current_filter Stores the list of current filters with the current one last.
     *
     * @param string $tag   The name of the filter hook.
     * @param mixed  $value The value on which the filters hooked to `$tag` are applied on.
     * @param mixed  $var   Additional variables passed to the functions hooked to `$tag`.
     * @return mixed The filtered value after all hooked functions are applied to it.
     */
    public static function apply_filters( $tag, $value ) {
        global $wp_filter, $merged_filters, $wp_current_filter;

        $args = array();

        // Do 'all' actions first.
        if ( isset($wp_filter['all']) ) {
            $wp_current_filter[] = $tag;
            $args = func_get_args();
            self::_wp_call_all_hook($args);
        }

        if ( !isset($wp_filter[$tag]) ) {
            if ( isset($wp_filter['all']) )
                array_pop($wp_current_filter);
            return $value;
        }

        if ( !isset($wp_filter['all']) )
            $wp_current_filter[] = $tag;

        // Sort.
        if ( !isset( $merged_filters[ $tag ] ) ) {
            ksort($wp_filter[$tag]);
            $merged_filters[ $tag ] = true;
        }

        reset( $wp_filter[ $tag ] );

        if ( empty($args) )
            $args = func_get_args();

        do {
            foreach( (array) current($wp_filter[$tag]) as $the_ )
                if ( !is_null($the_['function']) ){
                    $args[1] = $value;
                    $value = call_user_func_array($the_['function'], array_slice($args, 1, (int) $the_['accepted_args']));
                }

        } while ( next($wp_filter[$tag]) !== false );

        array_pop( $wp_current_filter );

        return $value;
    }

    /**
     * Converts a number of HTML entities into their special characters.
     *
     * Specifically deals with: &, <, >, ", and '.
     *
     * $quote_style can be set to ENT_COMPAT to decode " entities,
     * or ENT_QUOTES to do both " and '. Default is ENT_NOQUOTES where no quotes are decoded.
     *
     * @since 2.8.0
     *
     * @param string $string The text which is to be decoded.
     * @param mixed $quote_style Optional. Converts double quotes if set to ENT_COMPAT, both single and double if set to ENT_QUOTES or none if set to ENT_NOQUOTES. Also compatible with old _wp_specialchars() values; converting single quotes if set to 'single', double if set to 'double' or both if otherwise set. Default is ENT_NOQUOTES.
     * @return string The decoded text without HTML entities.
     */
    public static function wp_specialchars_decode( $string, $quote_style = ENT_NOQUOTES ) {
        $string = (string) $string;

        if ( 0 === strlen( $string ) ) {
            return '';
        }

        // Don't bother if there are no entities - saves a lot of processing
        if ( strpos( $string, '&' ) === false ) {
            return $string;
        }

        // Match the previous behaviour of _wp_specialchars() when the $quote_style is not an accepted value
        if ( empty( $quote_style ) ) {
            $quote_style = ENT_NOQUOTES;
        } elseif ( !in_array( $quote_style, array( 0, 2, 3, 'single', 'double' ), true ) ) {
            $quote_style = ENT_QUOTES;
        }

        // More complete than get_html_translation_table( HTML_SPECIALCHARS )
        $single = array( '&#039;'  => '\'', '&#x27;' => '\'' );
        $single_preg = array( '/&#0*39;/'  => '&#039;', '/&#x0*27;/i' => '&#x27;' );
        $double = array( '&quot;' => '"', '&#034;'  => '"', '&#x22;' => '"' );
        $double_preg = array( '/&#0*34;/'  => '&#034;', '/&#x0*22;/i' => '&#x22;' );
        $others = array( '&lt;'   => '<', '&#060;'  => '<', '&gt;'   => '>', '&#062;'  => '>', '&amp;'  => '&', '&#038;'  => '&', '&#x26;' => '&' );
        $others_preg = array( '/&#0*60;/'  => '&#060;', '/&#0*62;/'  => '&#062;', '/&#0*38;/'  => '&#038;', '/&#x0*26;/i' => '&#x26;' );

        if ( $quote_style === ENT_QUOTES ) {
            $translation = array_merge( $single, $double, $others );
            $translation_preg = array_merge( $single_preg, $double_preg, $others_preg );
        } elseif ( $quote_style === ENT_COMPAT || $quote_style === 'double' ) {
            $translation = array_merge( $double, $others );
            $translation_preg = array_merge( $double_preg, $others_preg );
        } elseif ( $quote_style === 'single' ) {
            $translation = array_merge( $single, $others );
            $translation_preg = array_merge( $single_preg, $others_preg );
        } elseif ( $quote_style === ENT_NOQUOTES ) {
            $translation = $others;
            $translation_preg = $others_preg;
        }

        // Remove zero padding on numeric entities
        $string = preg_replace( array_keys( $translation_preg ), array_values( $translation_preg ), $string );

        // Replace characters according to translation table
        return strtr( $string, $translation );
    }

    /**
     * Converts and fixes HTML entities.
     *
     * This function normalizes HTML entities. It will convert `AT&T` to the correct
     * `AT&amp;T`, `&#00058;` to `&#58;`, `&#XYZZY;` to `&amp;#XYZZY;` and so on.
     *
     * @since 1.0.0
     *
     * @param string $string Content to normalize entities
     * @return string Content with normalized entities
     */
    public static function wp_kses_normalize_entities($string) {
        // Disarm all entities by converting & to &amp;

        $string = str_replace('&', '&amp;', $string);

        // Change back the allowed entities in our entity whitelist

//		$string = preg_replace_callback('/&amp;([A-Za-z]{2,8}[0-9]{0,2});/', 'self::wp_kses_named_entities', $string);
//		$string = preg_replace_callback('/&amp;#(0*[0-9]{1,7});/', 'self::wp_kses_normalize_entities2', $string);
//		$string = preg_replace_callback('/&amp;#[Xx](0*[0-9A-Fa-f]{1,6});/', 'self::wp_kses_normalize_entities3', $string);


        return $string;
    }

    /**
     * Call the 'all' hook, which will process the functions hooked into it.
     *
     * The 'all' hook passes all of the arguments or parameters that were used for
     * the hook, which this function was called for.
     *
     * This function is used internally for apply_filters(), do_action(), and
     * do_action_ref_array() and is not meant to be used from outside those
     * functions. This function does not check for the existence of the all hook, so
     * it will fail unless the all hook exists prior to this function call.
     *
     * @since 2.5.0
     * @access private
     *
     * @param array $args The collected parameters from the hook that was called.
     */
    public static function _wp_call_all_hook($args) {
        global $wp_filter;

        reset( $wp_filter['all'] );
        do {
            foreach( (array) current($wp_filter['all']) as $the_ )
                if ( !is_null($the_['function']) )
                    call_user_func_array($the_['function'], $args);

        } while ( next($wp_filter['all']) !== false );
    }

    /**
     * Callback for wp_kses_normalize_entities() for regular expression.
     *
     * This function helps wp_kses_normalize_entities() to only accept valid Unicode
     * numeric entities in hex form.
     *
     * @access private
     *
     * @param array $matches preg_replace_callback() matches array
     * @return string Correctly encoded entity
     */
    public static function wp_kses_normalize_entities3($matches) {
        if ( empty($matches[1]) )
            return '';

        $hexchars = $matches[1];
        return ( ( ! self::valid_unicode(hexdec($hexchars)) ) ? "&amp;#x$hexchars;" : '&#x'.ltrim($hexchars,'0').';' );
    }

    /**
     * Callback for wp_kses_normalize_entities() regular expression.
     *
     * This function helps {@see wp_kses_normalize_entities()} to only accept 16-bit
     * values and nothing more for `&#number;` entities.
     *
     * @access private
     * @since 1.0.0
     *
     * @param array $matches preg_replace_callback() matches array
     * @return string Correctly encoded entity
     */
    function wp_kses_normalize_entities2($matches) {
        if ( empty($matches[1]) )
            return '';

        $i = $matches[1];
        if (self::valid_unicode($i)) {
            $i = str_pad(ltrim($i,'0'), 3, '0', STR_PAD_LEFT);
            $i = "&#$i;";
        } else {
            $i = "&amp;#$i;";
        }

        return $i;
    }

    /**
     * Helper function to determine if a Unicode value is valid.
     *
     * @param int $i Unicode value
     * @return bool True if the value was a valid Unicode number
     */
    public static function valid_unicode($i) {
        return ( $i == 0x9 || $i == 0xa || $i == 0xd ||
            ($i >= 0x20 && $i <= 0xd7ff) ||
            ($i >= 0xe000 && $i <= 0xfffd) ||
            ($i >= 0x10000 && $i <= 0x10ffff) );
    }

    /**
     * Callback for wp_kses_normalize_entities() regular expression.
     *
     * This function only accepts valid named entity references, which are finite,
     * case-sensitive, and highly scrutinized by HTML and XML validators.
     *
     * @since 3.0.0
     *
     * @param array $matches preg_replace_callback() matches array
     * @return string Correctly encoded entity
     */
    public static function wp_kses_named_entities($matches) {
        $allowedentitynames = array(
            'nbsp',    'iexcl',  'cent',    'pound',  'curren', 'yen',
            'brvbar',  'sect',   'uml',     'copy',   'ordf',   'laquo',
            'not',     'shy',    'reg',     'macr',   'deg',    'plusmn',
            'acute',   'micro',  'para',    'middot', 'cedil',  'ordm',
            'raquo',   'iquest', 'Agrave',  'Aacute', 'Acirc',  'Atilde',
            'Auml',    'Aring',  'AElig',   'Ccedil', 'Egrave', 'Eacute',
            'Ecirc',   'Euml',   'Igrave',  'Iacute', 'Icirc',  'Iuml',
            'ETH',     'Ntilde', 'Ograve',  'Oacute', 'Ocirc',  'Otilde',
            'Ouml',    'times',  'Oslash',  'Ugrave', 'Uacute', 'Ucirc',
            'Uuml',    'Yacute', 'THORN',   'szlig',  'agrave', 'aacute',
            'acirc',   'atilde', 'auml',    'aring',  'aelig',  'ccedil',
            'egrave',  'eacute', 'ecirc',   'euml',   'igrave', 'iacute',
            'icirc',   'iuml',   'eth',     'ntilde', 'ograve', 'oacute',
            'ocirc',   'otilde', 'ouml',    'divide', 'oslash', 'ugrave',
            'uacute',  'ucirc',  'uuml',    'yacute', 'thorn',  'yuml',
            'quot',    'amp',    'lt',      'gt',     'apos',   'OElig',
            'oelig',   'Scaron', 'scaron',  'Yuml',   'circ',   'tilde',
            'ensp',    'emsp',   'thinsp',  'zwnj',   'zwj',    'lrm',
            'rlm',     'ndash',  'mdash',   'lsquo',  'rsquo',  'sbquo',
            'ldquo',   'rdquo',  'bdquo',   'dagger', 'Dagger', 'permil',
            'lsaquo',  'rsaquo', 'euro',    'fnof',   'Alpha',  'Beta',
            'Gamma',   'Delta',  'Epsilon', 'Zeta',   'Eta',    'Theta',
            'Iota',    'Kappa',  'Lambda',  'Mu',     'Nu',     'Xi',
            'Omicron', 'Pi',     'Rho',     'Sigma',  'Tau',    'Upsilon',
            'Phi',     'Chi',    'Psi',     'Omega',  'alpha',  'beta',
            'gamma',   'delta',  'epsilon', 'zeta',   'eta',    'theta',
            'iota',    'kappa',  'lambda',  'mu',     'nu',     'xi',
            'omicron', 'pi',     'rho',     'sigmaf', 'sigma',  'tau',
            'upsilon', 'phi',    'chi',     'psi',    'omega',  'thetasym',
            'upsih',   'piv',    'bull',    'hellip', 'prime',  'Prime',
            'oline',   'frasl',  'weierp',  'image',  'real',   'trade',
            'alefsym', 'larr',   'uarr',    'rarr',   'darr',   'harr',
            'crarr',   'lArr',   'uArr',    'rArr',   'dArr',   'hArr',
            'forall',  'part',   'exist',   'empty',  'nabla',  'isin',
            'notin',   'ni',     'prod',    'sum',    'minus',  'lowast',
            'radic',   'prop',   'infin',   'ang',    'and',    'or',
            'cap',     'cup',    'int',     'sim',    'cong',   'asymp',
            'ne',      'equiv',  'le',      'ge',     'sub',    'sup',
            'nsub',    'sube',   'supe',    'oplus',  'otimes', 'perp',
            'sdot',    'lceil',  'rceil',   'lfloor', 'rfloor', 'lang',
            'rang',    'loz',    'spades',  'clubs',  'hearts', 'diams',
            'sup1',    'sup2',   'sup3',    'frac14', 'frac12', 'frac34',
            'there4',
        );

        if ( empty($matches[1]) )
            return '';

        $i = $matches[1];
        return ( ( ! in_array($i, $allowedentitynames) ) ? "&amp;$i;" : "&$i;" );
    }

    /**
     * Sanitize a string from user input or from the db
     *
     * check for invalid UTF-8,
     * Convert single < characters to entity,
     * strip all tags,
     * remove line breaks, tabs and extra white space,
     * strip octets.
     *
     * @since 2.9.0
     *
     * @param string $str
     * @return string
     */
    public static function sanitize_text_field($str) {
        $filtered = self::wp_check_invalid_utf8( $str );

        if ( strpos($filtered, '<') !== false ) {
            $filtered = self::wp_pre_kses_less_than( $filtered );
            // This will strip extra whitespace for us.
            $filtered = self::wp_strip_all_tags( $filtered, true );
        } else {
            $filtered = trim( preg_replace('/[\r\n\t ]+/', ' ', $filtered) );
        }

        $found = false;
        while ( preg_match('/%[a-f0-9]{2}/i', $filtered, $match) ) {
            $filtered = str_replace($match[0], '', $filtered);
            $found = true;
        }

        if ( $found ) {
            // Strip out the whitespace that may now exist after removing the octets.
            $filtered = trim( preg_replace('/ +/', ' ', $filtered) );
        }

        /**
         * Filter a sanitized text field string.
         *
         * @since 2.9.0
         *
         * @param string $filtered The sanitized string.
         * @param string $str      The string prior to being sanitized.
         */
        return self::apply_filters( 'sanitize_text_field', $filtered, $str );
    }
}