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

require_once 'JCopyTask.php';

/**
 * User: jlainezs
 * Date: 25/3/2016
 * Time: 19:46
 */
abstract class JCopyWithAdminTask extends JCopyTask
{
    protected $toAdmin = null;

    /**
     * Sets if module should be copied to the administrator modules
     *
     * @param string $str 'true' or '1' to direct the operation to the administrator
     */
    public function setToAdmin($str)
    {
        if ((mb_strtolower($str) == 'true') || ($str == '1')) {
            $this->toAdmin = true;
        } else {
            $this->toAdmin = false;
        }
    }

    /**
     * Gets the languages folder considering the toAdmin attribute
     * 
     * @return string
     */
    public function getJLanguagePath()
    {
        return $this->toAdmin ? $this->getJAdminLanguagePath() : $this->getJSiteLanguagePath();
    }
    
}