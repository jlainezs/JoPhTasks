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
 * @package    Phing-tasks\Joomla
 * @subpackage Tests\JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */

/**
 * Class CopyModuleTest
 *
 * Tests module copy task
 *
 * @package    Phing-tasks\Joomla
 * @subpackage Tests\JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */

class CopyModuleTest extends BuildFileTest
{
    /**
     * Prepare the test
     *
     * @return void
     */
    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/tasks/CopyModuleTaskTest.xml");
        $this->executeTarget("setup");
    }

    /**
     * Test end
     *
     * @return void
     */
    public function tearDown()
    {
        $this->executeTarget("clean");
    }

    /**
     * Test the module site copy
     *
     * @return void
     */
    public function testCopyModuleToSite()
    {

    }

    /**
     * Test the module administrator copy
     *
     * @return void
     */
    public function testCopyModuleToAdministrator()
    {

    }

    /*
    public function testCopyDanglingSymlink()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $this->markTestSkipped("Dangling symlinks don't work on Windows");
        }
        $this->executeTarget("testCopyDanglingSymlink");
        $this->assertInLogs("Copying 1 file to");
    }

    /**
     * Test for {@link http://www.phing.info/trac/ticket/981}
     * FileUtil::copyFile(): preserveLastModified causes
     * empty symlink target file
     *
    public function testCopySymlinkPreserveLastModifiedShouldCopyTarget()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $this->markTestSkipped("Bug not applicable on Window");
        }
        $this->executeTarget(__FUNCTION__);
        $this->assertInLogs("Copying 2 files to");
        $this->assertGreaterThan(0, $this->project->getProperty('test.filesize'));
    }
    */
}