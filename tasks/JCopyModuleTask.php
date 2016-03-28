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
 * Class JCopyModuleTask
 *
 * Copies a module source from srcPath to joomlaRoot.
 * The module source (srcPath) is supossed to have this structure.
 *
 * mod_mymodule
 *      languages (optional)
 *          en-GB
 *          ...whatever folders you need...
 *      ...whatever folders you need...
 *      media (optional)
 *          ...whatever folders you need...
 *      mymodule.php
 *      mymodule.xml
 *      ...whatever files you need
 */
class JCopyModuleTask extends JCopyWithAdminTask
{
    /**
     * Gets the path of extension being processed on the Joomla directory
     *
     * @return string
     */
    public function getJModulePath()
    {
        return  ($this->toAdmin ? $this->getJAdminModulesPath() : $this->getJSiteModulesPath()) . '/' . $this->extensionName;
    }
    
    /**
     * Executes the task
     */
    public function main()
    {
        parent::main();
        $this->copy($this->srcPath, $this->getJModulePath(), '*/**', 'languages/**,media/**');
        
        if (file_exists($this->srcPath . '/languages')) {
            $this->copy($this->srcPath . '/languages', $this->getJLanguagePath(), '*/**');
        }

        if (file_exists($this->srcPath . '/media')) {
            $this->copy($this->srcPath . '/media', $this->getJSiteMediaPath(), '*/**');
        }
    }
}