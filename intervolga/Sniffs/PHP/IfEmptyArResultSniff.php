<?php

namespace PHP_CodeSniffer\Standards\intervolga\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class IfEmptyArResultSniff implements Sniff
{
	public function register()
	{
		return [T_IF];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);
		if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
			$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
			if ($tokens[$next]['code'] === T_BOOLEAN_NOT) {
				$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
				if ($tokens[$next]['code'] === T_EMPTY) {
					$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
					if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
						$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
						if ($tokens[$next]['code'] === T_VARIABLE && $tokens[$next]['content'] === '$arResult') {
							$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
							if ($tokens[$next]['code'] === T_CLOSE_PARENTHESIS) {
								$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
								if ($tokens[$next]['code'] === T_CLOSE_PARENTHESIS) {
									$phpcsFile->addWarning('Use !$arResult instead of !empty($arResult)', $stackPtr, 'IfEmptyArResult');
								}
							}
						}
					}
				}
			}
		}
	}
}

?>