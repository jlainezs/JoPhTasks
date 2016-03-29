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
 * Class JCopyTemplateTask
 *
 * Copies a template source from srcPath to joomlaRoot.
 * The template source (srcPath) is supposed to have this structure.
 *
 *  my_template
 *      languages (optional)
 *          en-GB
 *          ...whatever folders you need...
 *      ...whatever folders you need...
 *      index.php
 *      templatedetails.xml
 *      ... other_files ...
 */
class JCopyTemplateTask extends JCopyWithAdminTask
{
    /**
     * Gets the template path
     * 
     * @return string
     */
    public function getJTemplatePath()
    {
        return ($this->toAdmin ? $this->getJAdminTemplatesPath() : $this->getJSiteTemplatesPath()) . '/' . $this->extensionName;
    }

    /**
     * Executes the task
     * 
     * @return void
     */
    public function main()
    {
        $this->validateAttributes();
        $targetDir = $this->getJTemplatePath();
        
        if ($this->mustPurge) {
            $this->purge($targetDir);
        }

        $exclude = 'languages/**';
        $this->copy($this->srcPath, $targetDir, '*/**', $exclude);

        if (file_exists($this->srcPath . '/languages')) {
            $this->copy($this->srcPath . '/languages', $this->getJAdminLanguagePath(), '*/**');
        }
    }
}