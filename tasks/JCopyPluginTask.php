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
 * Class JCopyPluginTask
 *
 * Copies a plugin source from srcPath to joomlaRoot.
 * The plugin source (srcPath) is supposed to have this structure.
 *
 *  my_plugin
 *      languages (optional)
 *          en-GB
 *          ...whatever folders you need...
 *      ...whatever folders you need...
 *      media (optional)
 *          ...whatever folders you need...
 *          ...whatever files you need ...
 *      my_plugin.php
 *      my_plugin.xml
 *      ... other_files ...
 */
class JCopyPluginTask extends JCopyTask
{
    private $pluginType;

    /**
     * Sets the plugin type
     * @param String $str Type of the plugin
     */
    public function setPluginType($str){
        $this->pluginType = $str;
    }

    /**
     * Validates the attributes of the task
     *
     * @throws BuildException
     */
    protected function validateAttributes()
    {
        parent::validateAttributes();
        if (empty($this->pluginType)) {
            throw new BuildException("Pls, set the plugin type.");
        }
    }

    protected function getPluginAndGroupPath(){
        $aSrc = explode('/',$this->srcPath);

        if (count($aSrc) > 2){
            return $aSrc[count($aSrc)-2] . '/' . $aSrc[count($aSrc)-1];
        }

        throw new BuildException("The plugins dir misses group and/or plugin name");
    }

    /**
     * Executes the task
     */
    public function main()
    {
        $this->validateAttributes();
        $targetDir = $this->getJSitePluginsDir() . '/' . $this->getPluginAndGroupPath();
        
        if ($this->mustPurge){
            $this->purge($targetDir);
        }
        
        $this->copy($this->srcPath, $targetDir, '*/**', 'languages/**,media/**');

        if (file_exists($this->srcPath . '/languages')) {
            $this->copy($this->srcPath . '/languages', $this->getJAdminLanguagePath(), '*/**');
        }

        if (file_exists($this->srcPath . '/media')) {
            $this->extensionName = 'plg_' . str_replace('/','_', $this->getPluginAndGroupPath());
            
            if ($this->mustPurge){
                $this->purge($this->getJSiteMediaPath());    
            }
            
            $this->copy($this->srcPath . '/media', $this->getJSiteMediaPath(), '*/**');
        }
    }
}