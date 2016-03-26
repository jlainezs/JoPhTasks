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
 * @subpackage JCopy\Tests
 * @author     Pep Lainez <contacte@econceptes.com>
 * @copyright  2016 Pep Lainez
 * @license    LGPL v3.0
 * @see        https://github.com/phingofficial/phing/blob/master/test/bootstrap.php
 */

defined('PHING_TEST_BASE') || define('PHING_TEST_BASE', dirname(__FILE__));

set_include_path(
    realpath(dirname(__FILE__) . '/../vendor/phing/phing/classes') . PATH_SEPARATOR .
    realpath(dirname(__FILE__) . '/tasks') . PATH_SEPARATOR .
    get_include_path()  // trunk version of phing classes should take precedence
);
require_once dirname(__FILE__) . '/classes/phing/BuildFileTest.php';
require_once 'phing/Phing.php';

// Use composers autoload.php if available
if (file_exists(dirname(__FILE__) . '/../vendor/autoload.php')) {
    include_once dirname(__FILE__) . '/../vendor/autoload.php';
} elseif (file_exists(dirname(__FILE__) . '/../../../autoload.php')) {
    include_once dirname(__FILE__) . '/../../../autoload.php';
}

Phing::setProperty('phing.home', realpath(dirname(__FILE__) . '/../'));
Phing::startup();
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT);