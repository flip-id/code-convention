<?php
/**
 * Created by
 * User: Rahman
 * Date: 16/04/20
 * Time: 19.16
 */

namespace Standard\Sniffs\Strings;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class EmbedVariableOnStringSniff implements Sniff
{
    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return [T_DOUBLE_QUOTED_STRING];
    }//end register()


    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param File  $phpcsFile The current file being checked.
     * @param int   $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        preg_match('/\$[a-z_0-9]+/', $tokens[$stackPtr]['content'], $matches);

        // No variable in string
        if (count($matches) === 0) {
            return;
        }

        $var_name = end($matches);

        preg_match('/\{\\' . $var_name . '\}/', $tokens[$stackPtr]['content'], $matches);

        if (count($matches) === 0) {
            $error = 'Embedded variable inside a string should be enclosed by a curly bracket; found %s';
            $data  = [trim($tokens[$stackPtr]['content'])];
            $phpcsFile->addError($error, $stackPtr, 'Found', $data);
        }
    }//end process()
}//end class
