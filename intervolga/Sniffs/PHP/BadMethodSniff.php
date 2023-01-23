<?php

namespace PHP_CodeSniffer\Standards\intervolga\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class BadMethodSniff implements Sniff
{	
	public function register()
	{
		return [T_OBJECT_OPERATOR];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);
		if ($tokens[$next]['code'] === T_STRING && $tokens[$next]['content'] === 'GetNextElement') {
			$phpcsFile->addWarning('Use GetNext() instead of GetNextElement()', $stackPtr, 'BadMethod');
		}
	}
	
}

?>
