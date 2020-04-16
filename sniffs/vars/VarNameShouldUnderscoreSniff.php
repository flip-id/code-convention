<?php
/**
 * Created by
 * User: Rahman
 * Date: 16/04/20
 * Time: 19.28
 */

namespace Standard\Sniffs\Strings;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Common;

class VarNameShouldUnderscoreSniff implements Sniff
{
    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return [T_VARIABLE];
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
        $var_name = str_replace('$', '', $tokens[$stackPtr]['content']);

        preg_match('/[A-Z^_]/', $var_name, $matches);

        if (count($matches) !== 0 && Common::isCamelCaps($var_name)) {
            $error = 'Variable "%s" is not in valid underscore format';
            $data  = [trim($tokens[$stackPtr]['content'])];
            $phpcsFile->addError($error, $stackPtr, 'Found', $data);
        }
    }//end process()
}//end class
