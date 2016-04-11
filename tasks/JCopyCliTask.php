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
 * @subpackage JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */

require_once 'JCopyWithAdminTask.php';

/**
 * Class JCopyCliTask
 *
 * Copies a template source from srcPath to joomlaRoot.
 * The template source (srcPath) is supposed to have this structure. *
 *
 * @package    Phing-tasks\Joomla
 * @subpackage JCopy
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 */
class JCopyCliTask extends JCopyWithAdminTask
{
    /**
     * Gets the template path
     *
     * @return string
     */
    public function getJCliPath()
    {
        return $this->getJHomePath() . '/cli';
    }

    /**
     * Executes the task
     *
     * @return void
     */
    public function main()
    {
        $this->mustPurge = false;   //don't allow purge
        $this->validateAttributes();
        $targetDir = $this->getJCliPath();

        $this->copy($this->srcPath, $targetDir, '*/**');
    }
}