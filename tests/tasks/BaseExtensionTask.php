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
 * Basic class for testing extensions handling
 *
 * @package    Phing-tasks\Joomla
 * @subpackage Tests\JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */
class BaseExtensionTask extends BuildFileTest
{
    /**
     * Prepare the test
     *
     * @return void
     */
    public function setUp()
    {
        $this->executeTarget("clean");  // enforce sample test site to be clean
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
     * Gets the sample site directory
     * 
     * @return string Path to the sample site dir
     */
    public function getSampleWwwPath()
    {
        return realpath($this->project->getProperty('site.dir'));
    }

    /**
     * Gets the sample administrator directory
     *
     * @return string Path to the sample administrator dir
     */
    public function getSampleAdminPath()
    {
        return realpath($this->project->getProperty('admin.dir'));
    }

    /**
     * Gets the sample site media directory
     *
     * @return string
     */
    public function getSampleMediaPath()
    {
        return realpath($this->project->getProperty('media.dir'));
    }

    /**
     * Returns a standard message for file not found tests
     * 
     * @param string $path path of the file not found
     * 
     * @return string
     */
    public function fileNotFoundMessage($path)
    {
        return sprintf("File %s not found", $path);
    }

}