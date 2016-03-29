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
 * Class CopyComponentTest
 *
 * Tests component copy task
 *
 * @package    Phing-tasks/Joomla
 * @subpackage Tests/JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */
class CopyComponentTest extends BaseExtensionTask
{
    /**
     * Prepare the test
     *
     * @return void
     */
    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/tasks/CopyComponentTaskTest.xml");
        parent::setUp();
    }
    
    /**
     * Test the module site copy
     *
     * @covers JCopyComponentTask::main
     * @covers JCopyComponentTask::getJAdminComponentPath
     * @covers JCopyComponentTask::getJAdminComponentsPath
     * @covers JCopyComponentTask::getJSiteComponentPath
     * @covers JCopyComponentTask::getJSiteComponentsPath
     *
     * @return void
     */
    public function testCopyComponent()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertInLogs("Copying 15 files to");
        $this->assertInLogs("Created 3 empty directories in");
        $this->assertInLogs("Copying 4 files to");
        $this->assertInLogs("Copying 9 files to");
        $this->assertInLogs("Created 3 empty directories in");
        $this->assertInLogs("Copying 4 files to");
        $this->assertInLogs("Created 4 empty directories in");
        $this->assertInLogs("Copying 2 files to");

        // ******* test files in site *****************
        $componentPath = $this->getSampleWwwPath() . '/components/com_test';
        $languagePath = $this->getSampleWwwPath() . '/language/ca-ES';
        // Does the module dir exists?
        $this->assertTrue(is_dir($componentPath));
        // Does the main module file exists?
        $this->assertFileExists($componentPath . '/controller.php');
        $this->assertFileExists($componentPath . '/index.html');
        $this->assertFileExists($componentPath . '/test.php');
        // Does language files exists?
        $this->assertFileExists($languagePath . '/ca-ES.com_test.sys.ini');
        $this->assertFileExists($languagePath . '/ca-ES.com_test.ini');

        // ******* test files in administrator *****************
        $componentPath = $this->getSampleAdminPath() . '/components/com_test';
        $languagePath = $this->getSampleAdminPath() . '/language/ca-ES';
        // Does the module dir exists?
        $this->assertTrue(is_dir($componentPath));
        // Does the main module file exists?
        $this->assertFileExists($componentPath . '/test.php');
        $this->assertFileExists($componentPath . '/access.xml');
        $this->assertFileExists($componentPath . '/config.xml');
        $this->assertFileExists($componentPath . '/controller.php');
        $this->assertFileExists($componentPath . '/index.html');
        // Does language files exists?
        $this->assertFileExists($languagePath . '/ca-ES.com_test.sys.ini');
        $this->assertFileExists($languagePath . '/ca-ES.com_test.ini');
    }
}