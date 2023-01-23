<?php

namespace PHP_CodeSniffer\Standards\dumpFunction\Sniffs\Dump;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class AdminUserDumpSniff implements Sniff
{
	public function register()
	{
		return [T_PRINT, T_ECHO];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$pos = $stackPtr;
		$token = $tokens[$pos];
		$error = true;
		while ($token['code'] != T_FUNCTION) {
			if ($token['code'] == T_IF) {
				$next = $phpcsFile->findNext(T_WHITESPACE, $pos + 1, null, true);
				if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
					$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
					if ($tokens[$next]['code'] === T_VARIABLE && $tokens[$next]['content'] === '$USER') {
						$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
						if ($tokens[$next]['code'] === T_OBJECT_OPERATOR) {
							$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
							if ($tokens[$next]['code'] === T_STRING && $tokens[$next]['content'] === 'GetID') {
								$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
								if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
									$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
									if ($tokens[$next]['code'] === T_CLOSE_PARENTHESIS) {
										$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
										if ($tokens[$next]['code'] === T_IS_EQUAL) {
											$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);
											if ($tokens[$next]['code'] === T_LNUMBER && $tokens[$next]['content'] === '1') {
												$error = false;
											}
										}
									}
								}
							}
						}
					}
				}
			}
			$pos--;
			$token = $tokens[$pos];
		}

		if ($error) {
			$phpcsFile->addWarning('Check user for an admin before printing', $stackPtr, 'AdminUserDump');
		}
	}
}

?>

