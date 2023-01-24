<?php

namespace PHP_CodeSniffer\Standards\intervolga\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ArraySniff implements Sniff
{
	public function register()
	{
		return [T_ARRAY, T_OPEN_SHORT_ARRAY];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		if ($token['code'] === T_ARRAY) {
			$phpcsFile->addWarning('Use [] instead of Array()', $stackPtr, 'Array');
		}
	}
}

?>
