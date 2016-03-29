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
 * Class CopyExtensionTaskExceptionsTest
 *
 * Tests module copy task
 *
 * @package    Phing-tasks/Joomla
 * @subpackage Tests/JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */
class CopyExtensionTaskExceptionsTest extends BaseExtensionTask
{
    /**
     * Prepare the test
     *
     * @return void
     */
    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/tasks/CopyExtensionTaskExceptionsTest.xml");
        parent::setUp();
    }
    
    /**
     * Test that an exception is raised when no joomla root is specified
     * 
     * @covers            JCopyModuleTask::main
     * @expectedException BuildException
     *
     * @return void
     */
    public function testCopyModuleToSiteNoJoomlaRootSpecified()
    {
        $this->executeTarget(__FUNCTION__);
    }
    
    /**
     * Test that an exception is raised when no origin path is speficied
     * 
     * @covers            JCopyModuleTask::main
     * @expectedException BuildException
     *
     * @return void
     */
    public function testCopyModuleToSiteNoSourcePathSpecified()
    {
        $this->executeTarget(__FUNCTION__);
    }
}