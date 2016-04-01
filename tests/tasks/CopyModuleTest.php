<?php
/**
 * Phing tasks for Joomla Extension Development
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    Phing-tasks/Joomla
 * @subpackage Tests/JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */

/**
 * Class CopyModuleTest
 *
 * Tests module copy task
 *
 * @package    Phing-tasks/Joomla
 * @subpackage Tests/JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */
class CopyModuleTest extends BaseExtensionTask
{
    /**
     * Prepare the test
     *
     * @return void
     */
    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/tasks/CopyModuleTaskTest.xml");
        parent::setUp();
    }
    
    /**
     * Test the module site copy
     * 
     * @covers JCopyModuleTask::main
     * @covers JCopyModuleTask::getJModulePath
     * @covers JCopyTask::getJSiteModulesPath
     * @covers JCopyWithAdminTask::getJLanguagePath
     * @covers JCopyTask::getJSiteMediaPath
     *
     * @return void
     */
    public function testCopyModuleToSite()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertInLogs("Created 2 empty directories");
        $this->assertInLogs("Copying 3 files to");
        $this->assertInLogs("Created 3 empty directories in");
        $this->assertInLogs("Copying 4 files to");
        $this->assertInLogs("Copying 4 files to");
        $modulePath = $this->getSampleWwwPath() . '/modules/mod_test';
        $languagePath = $this->getSampleWwwPath() . '/language/ca-ES';
        // Does the module dir exists?
        $this->assertTrue(is_dir($modulePath));
        // Does the main module file exists?
        $this->assertFileExists($modulePath . '/mod_test.php');
        $this->assertFileExists($modulePath . '/mod_test.xml');
        // Does language files exists?
        $this->assertFileExists($languagePath . '/ca-ES.mod_test.sys.ini');
    }

    /**
     * Test the module administrator copy
     *
     * @covers JCopyModuleTask::main
     * @covers JCopyModuleTask::getJModulePath
     * @covers JCopyTask::getJAdminModulesPath
     * @covers JCopyWithAdminTask::getJLanguagePath
     * @covers JCopyTask::getJSiteMediaPath
     *
     * @return void
     */
    public function testCopyModuleToAdministrator()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertInLogs("Created 2 empty directories");
        $this->assertInLogs("Copying 3 files to");
        $this->assertInLogs("Created 3 empty directories in");
        $this->assertInLogs("Copying 4 files to");
        $this->assertInLogs("Copying 4 files to");
        $modulePath = $this->getSampleAdminPath() . '/modules/mod_test';
        $languagePath = $this->getSampleAdminPath() . '/language/ca-ES';
        // Does the module dir exists?
        $this->assertTrue(is_dir($modulePath));
        // Does the main module file exists?
        $this->assertFileExists($modulePath . '/mod_test.php');
        $this->assertFileExists($modulePath . '/mod_test.xml');
        // Does language files exists?
        $this->assertFileExists($languagePath . '/ca-ES.mod_test.sys.ini');
    }

    /**
     * Test the module copy with copy disabled
     * 
     * @covers JCopyModuleTask::purge
     * 
     * @return void
     */
    public function testCopyModuleToSitePurgeDisabled()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertFileExists($this->getSampleWwwPath() . '/modules/mod_test/not_deleted.php');
    }

    /**
     * Test the module copy with copy enabled
     *
     * @covers JCopyModuleTask::purge 
     * 
     * @return void
     */
    public function testCopyModuleToSitePurgeEnabled()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertFileNotExists($this->getSampleWwwPath() . '/modules/mod_test/should_be_deleted.php');
    }
}