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
 * Class CopyTemplateTest
 *
 * Tests template copy task
 *
 * @package    Phing-tasks/Joomla
 * @subpackage Tests/JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */
class CopyTemplateTest extends BaseExtensionTask
{
    /**
     * Prepare the test
     *
     * @return void
     */
    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/tasks/CopyTemplateTaskTest.xml");
        parent::setUp();
    }
    
    /**
     * Test the template site copy
     *
     * @covers JCopyTemplateTask::main
     * @covers JCopyTemplateTask::getJTemplatePath
     * @covers JCopyTask::getJSiteTemplatesPath
     *
     * @return void
     */
    public function testCopyTemplateToSite()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertInLogs("Created 7 empty directories");
        $this->assertInLogs("Copying 6 files to");
        $this->assertInLogs("Created 3 empty directories in");
        $this->assertInLogs("Copying 4 files to");
        $templatePath = $this->getSampleWwwPath() . '/templates/tsttemplate';
        $languagePath = $this->getSampleAdminPath() . '/language/ca-ES';
        // Does the module dir exists?
        $this->assertTrue(is_dir($templatePath));
        // Does the main module file exists?
        $this->assertFileExists($templatePath . '/index.php');
        $this->assertFileExists($templatePath . '/templatedetails.xml');
        // Does language files exists?
        $this->assertFileExists($languagePath . '/ca-ES.tpl_tsttemplate.ini');
        $this->assertFileExists($languagePath . '/ca-ES.tpl_tsttemplate.sys.ini');
    }

    /**
     * Test the template administrator copy
     *
     * @covers JCopyTemplateTask::main
     * @covers JCopyTemplateTask::getJTemplatePath
     * @covers JCopyTask::getJAdminTemplatesPath
     *
     * @return void
     */
    public function testCopyTemplateToAdministrator()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertInLogs("Created 7 empty directories");
        $this->assertInLogs("Copying 6 files to");
        $this->assertInLogs("Created 3 empty directories in");
        $this->assertInLogs("Copying 4 files to");
        $modulePath = $this->getSampleAdminPath() . '/templates/tsttemplate';
        $languagePath = $this->getSampleAdminPath() . '/language/ca-ES';
        // Does the module dir exists?
        $this->assertTrue(is_dir($modulePath));
        // Does the main module file exists?
        $this->assertFileExists($modulePath . '/index.php');
        $this->assertFileExists($modulePath . '/templatedetails.xml');
        // Does language files exists?
        $this->assertFileExists($languagePath . '/ca-ES.tpl_tsttemplate.ini');
        $this->assertFileExists($languagePath . '/ca-ES.tpl_tsttemplate.sys.ini');
    }

    /**
     * Test the template copy with purge disabled
     *
     * @return void
     */
    public function testCopyTemplatePurgeDisabled()
    {
        $this->executeTarget(__FUNCTION__);
        $templatePath = $this->getSampleWwwPath() . '/templates/tsttemplate';
        $this->assertFileExists($templatePath . '/not_deleted.php');
    }

    /**
     * Test the template copy with purge enabled
     *
     * @return void
     */
    public function testCopyTemplatePurgeEnabled()
    {
        $this->executeTarget(__FUNCTION__);
        $templatePath = $this->getSampleWwwPath() . '/templates/tsttemplate';
        $this->assertFileNotExists($templatePath . '/should_be_deleted.php');
    }
}