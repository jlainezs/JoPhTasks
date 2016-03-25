<?php
/**
 * @package     Phing-tasks\Joomla
 * @subpackage  JCopy
 * @author      Pep Lainez <contacte@econceptes.com>
 * @license     LGPL v3.0
 * @copyright   2016 Pep Lainez
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
 */
require_once 'JCopyTask.php';

/**
 * Class JCopyComponentTask
 *
 * Copies a component source from srcPath to joomlaRoot.
 * The component source (srcPath) is supposed to have this structure:
 *
 * com_mycomponent
 *      administrator
 *          controllers
 *          views
 *          ...whatever folders you need...
 *          languages (optional)
 *              en-GB
 *              ...whatever folders you need...
 *          mycomponent.php
 *          controller.php
 *          ... whatever files you need ...
 *      site
 *          controllers
 *          views
 *          ...whatever folders you need...
 *          languages (optional)
 *              en-GB
 *              ...whatever folders you need...
 *          mycomponent.php
 *          controller.php
 *          ... whatever files you need ...
 *      media (optional)
 *          ...whatever folders you need...
 *          ... whatever files you need ...
 */
class JCopyComponentTask extends JCopyTask
{
    protected function getJAdminComponentPath(){
        return $this->getJAdminComponentsPath() . '/' . $this->extensionName;
    }

    protected function getJSiteComponentPath(){
        return $this->getJSiteComponentsPath() . '/' . $this->extensionName;
    }

    /**
     * Executes the task
     */
    public function main()
    {
        $this->validateAttributes();

        // administrator
        $this->copy($this->srcPath . '/administrator', $this->getJAdminComponentPath(), '*/**', 'languages/**');

        if(file_exists($this->srcPath . '/administrator/languages')) {
            $this->copy($this->srcPath . '/administrator/languages', $this->getJAdminLanguagePath(), '*/**');
        }

        // site
        $this->copy($this->srcPath . '/site', $this->getJSiteComponentPath(), '*/**', 'languages/**');

        if (file_exists($this->srcPath . '/site/languages')) {
            $this->copy($this->srcPath . '/site/languages', $this->getJSiteLanguagePath(), '*/**');
        }

        // media
        if (file_exists($this->srcPath . '/media')) {
            $this->copy($this->srcPath . '/media', $this->getJSiteMediaPath(), '*/**');
        }

    }

}