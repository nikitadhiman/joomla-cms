<?php
/**
 * JVersionTest
 *
 * @version   $Id$
 * @package   Joomla.UnitTest
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters. All rights reserved.
 * @license   GNU General Public License
 */
require_once 'PHPUnit/Framework.php';
/**
 * JVersionTest
 *
 * Test class for JVersion.
 * Generated by PHPUnit on 2009-10-08 at 21:36:41.
 *
 * @package	Joomla.UnitTest
 * @subpackage Utilities
 */
class JVersionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var	JVersion
	 */
	protected $object;
	protected $PRODUCT	= 'Joomla!';
	protected $RELEASE	= '12.23';
	protected $DEV_STATUS	= 'Testing';
	protected $DEV_LEVEL	= '999';
	protected $BUILD		= '99999';
	protected $CODENAME	= 'Desperation';
	protected $RELDATE	= '22-June-3109';
	protected $RELTIME	= '13:13';
	protected $RELTZ		= 'CDT';
	protected $COPYRIGHT	= 'Copyright (C) 2005 - 3109 Open Source Matters. All rights reserved.';
	protected $URL		= '<a href="http://www.joomla.org">Joomla!</a> is Free Software released under the GNU General Public License.';

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		$this->object = new JVersion;
		$this->object->PRODUCT	= $this->PRODUCT;
		$this->object->RELEASE = $this->RELEASE;
		$this->object->DEV_STATUS = $this->DEV_STATUS;
		$this->object->DEV_LEVEL = $this->DEV_LEVEL;
		$this->object->BUILD = $this->BUILD;
		$this->object->CODENAME = $this->CODENAME;
		$this->object->RELDATE = $this->RELDATE;
		$this->object->RELTIME = $this->RELTIME;
		$this->object->RELTZ = $this->RELTZ;
		$this->object->COPYRIGHT = $this->COPYRIGHT;
		$this->object->URL = $this->URL;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */
	protected function tearDown()
	{
	}

	/**
	 * This checks for the correct Long Version.
	 *
	 * @return void
	 */
	public function testGetLongVersion()
	{
		$expected = 'Joomla! 12.23.999 Testing [ Desperation ] 22-June-3109 13:13 CDT';
		$this->assertEquals(
			$expected,
			$this->object->getLongVersion(),
			'Should get the correct Long Version'
		);
	}

	/**
	 * This checks for the correct Short Version.
	 *
	 * @return void
	 */
	public function testGetShortVersion()
	{
		$expected = '12.23.999';
		$this->assertEquals(
			$expected,
			$this->object->getShortVersion(),
			'Should get the correct Short Version'
		);
	}

	/**
	 * Help test cases
	 *
	 * @return array
	 */
	function casesHelp()
	{
		return array(
			'AsSet' => array(
				null,
				'.1223',
				'Should get the correct Help version',
			),
			'1.0' => array(
				'',
				'',
				'Should get an empty Help version',
			),
		);

	}

	/**
	 * This checks for the correct Help Version.
	 *
	 * @param	string	$release	Joomla release number
	 * @param	string	$expect		Expected help Version
	 * @param	string	$message	Test failure message
	 *
	 * @return void
	 * @dataProvider casesHelp
	 */
	public function testGetHelpVersion( $release, $expect, $message )
	{
		if (is_null($release))
		{
			$output = $this->object->getHelpVersion();
		}
		else
		{
			$this->object->RELEASE	= '1.0';
			$output = $this->object->getHelpVersion();
		}

		$this->assertEquals(
			$expect,
			$output,
			$message
		);
	}

	/**
	 * Compatibility test cases
	 *
	 * @return array
	 */
	function casesCompatibility()
	{
		return array(
			'wrong' => array(
				'0.3',
				false,
				'Should not be compatible with 0.3',
			),
			'empty' => array(
				'',
				false,
				'Should not be compatible with empty string',
			),
			'null' => array(
				null,
				false,
				'Should not be compatible with null',
			),
			'itself' => array(
				JVERSION,
				true,
				'Should be compatible with itself',
			),
			'version 1.6.9' => array(
				'1.6.9',
				true,
				'Should be compatible with 1.6.9',
			),
			'version 1.6.99' => array(
				'1.6.99',
				true,
				'Should be compatible with 1.6.99',
			),
			'version 1.6.0-betaxx' => array(
				'1.6.0-betaxx',
				true,
				'Should be compatible with 1.6.0-betaxx',
			),
			'version 1.5.22' => array(
				'1.5.22',
				false,
				'Should not be compatible with 1.5.22',
			),
			'version 1.7.0' => array(
				'1.7.0',
				false,
				'Should not be compatible with 1.7.0',
			),
		);

	}

	/**
	 * This checks the compatibility testing method.
	 *
	 * @param	string	$input		Version
	 * @param	bool	$expect		expected result of version check
	 * @param	string	$message	Test failure message
	 *
	 * @return void
	 * @dataProvider casesCompatibility
	 */
	public function testIsCompatible( $input, $expect, $message )
	{
		$this->assertThat(
			$expect,
			$this->equalTo($this->object->isCompatible($input)),
			$message
		);
	}

	/**
	 * User Agent test cases
	 *
	 * @return array
	 */
	function casesUserAgent()
	{
		return array(
			'defaults' => array(
				'',
				false,
				true,
				'Joomla!/12.23.999 Framework/12.23',
				'Should get the default Framework User Agent',
				true
			),
			'Def/Null/Ver' => array(
				null,
				null,
				true,
				'Joomla!/12.23.999 Framework/12.23',
				'Should get the default Framework User Agent with version',
				false
			),
			'Def/Def/Ver' => array(
				null,
				false,
				true,
				'Joomla!/12.23.999 Framework/12.23',
				'Should get the default Framework User Agent with version',
				false
			),
			'Def/Def/noVer' => array(
				null,
				false,
				false,
				'Joomla!/12.23.999 Framework',
				'Should get the default Framework User Agent without version',
				false
			),
			'Def/Moz/noVer' => array(
				null,
				true,
				false,
				'Mozilla/5.0 Joomla!/12.23.999 Framework',
				'Should get the Mozilla Framework User Agent without version',
				false
			),
			'Def/Moz/Ver' => array(
				null,
				true,
				true,
				'Mozilla/5.0 Joomla!/12.23.999 Framework/12.23',
				'Should get the Mozilla Framework User Agent with version',
				false
			),
			'CMS/Nulls' => array(
				'CMS',
				null,
				null,
				'Joomla!/12.23.999 CMS/12.23',
				'Should get the default CMS User Agent with version',
				false
			),
			'CMS/Def/Ver' => array(
				'CMS',
				false,
				true,
				'Joomla!/12.23.999 CMS/12.23',
				'Should get the default CMS User Agent with version',
				false
			),
			'CMS/Def/noVer' => array(
				'CMS',
				false,
				false,
				'Joomla!/12.23.999 CMS',
				'Should get the default CMS User Agent without version',
				false
			),
			'CMS/Moz/Ver' => array(
				'CMS',
				true,
				true,
				'Mozilla/5.0 Joomla!/12.23.999 CMS/12.23',
				'Should get the Mozilla CMS User Agent',
				false
			),
			'CMS/Moz/noVer' => array(
				'CMS',
				true,
				false,
				'Mozilla/5.0 Joomla!/12.23.999 CMS',
				'Should get the Mozilla CMS User Agent without version',
				false
			),
		);

	}

	/**
	 * This checks for generation of the correct user agent string.
	 *
	 * @param	string	$component		default "Framework"
	 * @param	bool	$mask			mask user agent as Mozilla
	 * @param	bool	$addVersion		Add Version to UA String
	 * @param	string	$expect			expected result
	 * @param	string	$message		Test failure message
	 * @param	bool	$useDefaults	use no arguments, accept function default
	 *
	 * @return void
	 * @dataProvider casesUserAgent
	 */
	public function testSettingCorrectUserAgentString( $component, $mask, $addVersion,
	$expect, $message, $useDefaults ) {
		if ( $useDefaults )
		{
			$output = $this->object->getUserAgent();
		}
		else if (is_null($mask))
		{
			$output = $this->object->getUserAgent($component);
		}
		else if (is_null($addVersion))
		{
			$output = $this->object->getUserAgent($component, $mask);
		}
		else
		{
			$output = $this->object->getUserAgent($component, $mask, $addVersion);
		}
		$this->assertEquals(
			$expect,
			$output,
			$message
		);
	}

	/**
	 * This checks for correct operation of the __set_state() magic function, if it exists.
	 *
	 * @return void
	 */
	public function testSetState()
	{
		if (method_exists('JVersion', '__set_state'))
		{
			$testData = array(
				'PRODUCT' => 'Joomla!',
				'RELEASE' => '1.6',
				'DEV_STATUS' => 'Alpha',
				'DEV_LEVEL' => '0',
				'BUILD' => '',
				'CODENAME' => 'Hope',
				'RELDATE' => '22-June-2009',
				'RELTIME' => '23:00',
				'RELTZ' => 'GMT',
				'COPYRIGHT' => 'Copyright (C) 2005 - 2012 Open Source Matters. All rights reserved.',
				'URL' => '<a href="http://www.joomla.org">Joomla!</a> is Free Software released under the GNU General Public License.'
			);

			$testInstance = $this->object->__set_state($testData);
			foreach ($testData as $key => $value)
			{
				$this->assertThat(
					$testInstance->$key,
					$this->equalTo($value)
				);
			}
			$this->assertThat(
				$testInstance,
				$this->isInstanceOf('JVersion')
			);
		}
	}
}

