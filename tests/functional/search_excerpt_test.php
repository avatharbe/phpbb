<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

/**
* @group functional
*/
class phpbb_functional_search_excerpt_test extends phpbb_functional_test_case
{
	public function test_text_only_excerpt_has_no_markup()
	{
		$this->login();

		// The installer stores the welcome post as <t>...</t> without a BBCode uid,
		// and a short excerpt length forces the text only display
		$crawler = self::request('GET', 'search.php?author_id=2&sr=posts&ch=40');

		$excerpts = $crawler->filter('.postbody .content');
		$this->assertGreaterThan(0, $excerpts->count());
		foreach ($excerpts as $excerpt)
		{
			$this->assertStringNotContainsString('<t>', $excerpt->textContent);
			$this->assertStringNotContainsString('<r>', $excerpt->textContent);
		}
	}
}
