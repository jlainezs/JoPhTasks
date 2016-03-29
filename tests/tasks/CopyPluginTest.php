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
 * Class CopyPluginTest
 *
 * Tests plugin copy task
 *
 * @package    Phing-tasks/Joomla
 * @subpackage Tests/JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */
class CopyPluginTest extends BaseExtensionTask
{
    /**
     * Prepare the test
     *
     * @return void
     */
    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/tasks/CopyPluginTaskTest.xml");
        parent::setUp();
    }
    
    /**
     * Test the plugin site copy
     * 
     * @covers JCopyPluginTask::main
     * @covers JCopyTask::getJSitePluginsDir
     * @covers JCopyPluginTask::getPluginAndGroupPath
     *
     * @return void
     */
    public function testCopyPlugin()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertInLogs("Created 1 empty directory");
        $this->assertInLogs("Copying 2 files");
        $this->assertInLogs("Created 3 empty directories in");
        $this->assertInLogs("Copying 4 files to");
        $this->assertInLogs("Created 2 empty directories in");
        $this->assertInLogs("Copying 1 file to");
        $pluginPath = $this->getSampleWwwPath() . '/plugins/content/testplugin';
        $languagePath = $this->getSampleAdminPath() . '/language/ca-ES';
        // Does the module dir exists?
        $this->assertTrue(is_dir($pluginPath));
        // Does the main plugin files exists?
        $this->assertFileExists($pluginPath . '/testplugin.php');
        $this->assertFileExists($pluginPath . '/testplugin.xml');
        // Does language files exists?
        $this->assertFileExists($languagePath . '/ca-ES.plg_content_testplugin.ini');
        $this->assertFileExists($languagePath . '/ca-ES.plg_content_testplugin.sys.ini');
    }

    /**
     * Test that a no plugin exception is raised
     *
     * @covers            JCopyPluginTask::main
     * @covers            JCopyPluginTask::validateAttributes
     * @expectedException BuildException
     */
    public function testCopyPluginNoPluginTypeException()
    {
        $this->executeTarget(__FUNCTION__);
    }
    
    /**
     * Test that plugin src directory misses the group or the plugin name 
     *
     * @covers            JCopyPluginTask::main
     * @covers            JCopyPluginTask::getPluginAndGroupPath
     * @expectedException BuildException
     */
    public function testCopyPluginNoPluginGroupException()
    {
        $this->executeTarget(__FUNCTION__);
    }
}