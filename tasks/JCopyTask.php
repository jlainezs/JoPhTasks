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

require_once "phing/Task.php";
require_once 'phing/tasks/system/CopyTask.php';

/**
 * Class JCopyTask
 *
 * Base class for Joomla extensions copy tasks
 */
abstract class JCopyTask extends Task
{
    /**
     * Where Joomla is located 
     * @var string
     */
    protected $joomlaRoot = null;

    /**
     * Where source files are
     * @var string
     */
    protected $srcPath = null;

    /**
     * Extension name. It is guessed from the the directory structure
     * @var string
     */
    protected $extensionName = null;

    /**
     * If true (default) temoves target directories before copying.
     * This allows to clean the target directory.
     * @var bool
     */
    protected $mustPurge = true;

    /**
     * Quotes extra information
     * @var int
     */
    protected $verbosity = Project::MSG_VERBOSE;

    /**
	 * The init method: Do init steps.
	 */
	public function init()
	{
		// nothing to do here
	}

	/**
	 * Validates the attributes of the task
	 *
	 * @throws BuildException
	 */
	protected function validateAttributes()
	{
		if (empty($this->joomlaRoot)) {
			throw new BuildException("Pls, set Joomla home.");
		}

		if (empty($this->srcPath)) {
			throw new BuildException("Pls, set a source path to copy from.");
		}
	}


    /**
     * Used to force listing of all names of deleted files.
     * @param boolean $verbosity
     */
    public function setVerbose($verbosity)
    {
        if ($verbosity) {
            $this->verbosity = Project::MSG_INFO;
        } else {
            $this->verbosity = Project::MSG_VERBOSE;
        }
    }
    
    /**
     * If true of 1 de destinations folders will be removed before copying 
     * 
     * @param  boolean  $mustClean
     */
    public function setPurge($mustClean)
    {
        if ($mustClean){
            $this->mustPurge = true;
        } else {
            $this->mustPurge = false;
        }
    }

	/**
	 * Sets the Joomla directory
	 * @param $str
	 */
    public function setJoomlaRoot($str){
        if (mb_substr($str,mb_strlen($str)-1,1) == '/')
        {
            $str = mb_substr($str,0, mb_strlen($str)-1);
        }
        $this->joomlaRoot = $str;
    }

	/**
	 * Sets the source path
	 * @param $str
	 */
    public function setSourcePath($str){
        $this->srcPath = $str;
        $parts = explode('/',$str);

        if (count($parts)) {
            $this->extensionName = $parts[count($parts) - 1];
        }
    }

	/**
	 * Gets the Joomla admininstrator path
	 * @return string
	 */
    protected function getJAdminPath()
    {
        return $this->getJHomePath() . '/administrator';
    }

	/**
	 * Gets the Joomla administrator components path
	 * @return string
	 */
    protected function getJAdminComponentsPath()
    {
        return $this->getJAdminPath() . '/components';
    }

    /**
     * Gets the Joomla administrator language path
     * @return string
     */
    protected function getJAdminLanguagePath()
    {
        return $this->getJAdminPath() . '/language';
    }

    /**
     * Gets the Joomla home directory (this is where joomla is installed)
     *
     * @return string
     */
    public function getJHomePath()
    {
        return $this->joomlaRoot;
    }

    /**
     * Gets the Joomla site components directory
     *
     * @return string
     */
    public function getJSiteComponentsPath()
    {
        return $this->getJHomePath() . '/components';
    }

    /**
     * Gets the Joomla site language path for the given tag.
     * If no tag is given it returns the path to the language folder.
     *
     * @param  string $tag Language tag (i.e. en-GB)
     *
     * @return string
     *
     */
    public function getJSiteLanguagePath($tag = null)
    {
        return $this->getJHomePath() . '/language' . ($tag ? "/$tag" : "");
    }

    /**
     * Gets the media folder for the extension
     *
     * @return string
     */
    public function getJSiteMediaPath()
    {
        return $this->getJHomePath() . '/media/' . $this->extensionName;
    }

    /**
     * Gets the modules folder on the site
     *
     * @return string
     */
	public function getJSiteModulesPath()
    {
		return $this->getJHomePath() . '/modules';
	}

    /**
     * Gets the modules folder on the administrator
     *
     * @return string
     */
    public function getJAdminModulesPath()
    {
        return $this->getJAdminPath() . '/modules';
    }

    /**
     * Gets the plugins folder
     *
     * @return string
     */
	public function getJSitePluginsDir()
    {
		return $this->getJHomePath() . '/plugins';
	}

    /**
     * Gets the templates folder
     * 
     * @return string
     */
    public function getJSiteTemplatesPath()
    {
        return $this->getJHomePath() . '/templates';
    }

    /**
     * Gets the administrator templates folder
     * 
     * @return string
     */
    public function getJAdminTemplatesPath()
    {
        return $this->getJAdminPath() . '/templates';    
    }

    /**
     * Executes a copy task
     *
     * @param  String  $from      Origin
     * @param  String  $to        Destination of the copy
     * @param  String  $includes  Include files expression
     * @param  string  $excludes  Exclude files expression
     *
     * @throws  BuildException
     * @throws  Exception
     */
    protected function copy($from, $to, $includes, $excludes = ''){

        $fromPF = new PhingFile($from);
        $toPF = new PhingFile($to);
        $fs = new FileSet();
        $fs->setDir($fromPF);
        $fs->setIncludes($includes);

        if (!empty($excludes)) {
            $fs->setExcludes($excludes);
        }

        $cp = new CopyTask();
        $cp->setProject($this->getProject());
        $cp->setTodir($toPF);
        $cp->setOverwrite(TRUE);
        $cp->addFileSet($fs);
        $cp->main();
    }

    /**
     * Deletes the given directory
     * 
     * @param  string  $fso
     */
    protected function purge($fso, $includes = '*/**', $excludes = '')
    {
        $directory = new PhingFile($fso);
        $delete = new DeleteTask();
        $delete->setProject($this->getProject());
        $fs = new FileSet();
        $fs->setDir($directory);
        $fs->setIncludes($includes);
        
        if ($excludes != '') {
            $fs->setExcludes($excludes);
        }
        
        $delete->addFileSet($fs);        
        $delete->main();
    }

	/**
	 * Task entry point. Executes attributes validation
	 *
	 * @throws BuildException
	 */
	public function main(){
		$this->validateAttributes();
	}
}